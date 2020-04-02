import { fetchUtils } from 'react-admin';
import apiProvider from 'ra-iri-jsonapi-client';

const settings = {
  headers: {
    'Accept': 'application/vnd.api+json',
    'Content-Type': 'application/vnd.api+json',
  }
};

const httpClient = (url, options = {}) => {
    if (!options.headers) {
        options.headers = new Headers({ Accept: 'application/json' });
    }
    const token = localStorage.getItem('token');
    options.headers.set('Authorization', `Bearer ${token}`);
    return fetchUtils.fetchJson(url, options);
}

const API_ENDPOINT = process.env.REACT_APP_API_ENDPOINT;

const provider = apiProvider(API_ENDPOINT, { ...httpClient, ...settings });

const customDataProvider = {
    ...provider,
    create: (resource, params) => {
        if (resource !== 'products' || !params.data.image) {
            return provider.update(resource, params);
        }

        const newPictures = params.data.image.filter(
            p => p.rawFile instanceof File
        );
        const formerPicture = params.data.image.filter(
            p => !(p.rawFile instanceof File)
        );

        return Promise.all(newPictures.map(convertFileToBase64))
            .then(picture64 => ({
                    src: picture64,
                    title: `${params.data.title}`,
                })
            )
            .then(transformedNewPicture =>
                provider.update(resource, {
                    ...params,
                    data: {
                        ...params.data,
                        image: [
                            ...transformedNewPicture,
                            ...formerPicture,
                        ],
                    },
                })
            );
    },
};

const convertFileToBase64 = file =>
    new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file.rawFile);

        reader.onload = () => resolve(reader.result);
        reader.onerror = reject;
    });

export default customDataProvider;
