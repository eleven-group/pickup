import {
    AUTH_LOGIN,
    AUTH_LOGOUT,
    AUTH_ERROR,
    AUTH_CHECK,
    AUTH_GET_PERMISSIONS
} from 'react-admin';

const API_ENDPOINT = process.env.REACT_APP_API_ENDPOINT;

const authProvider = {
    login: ({ username, password }) => {
        const request = new Request(`${process.env.REACT_APP_API_ENDPOINT}/login_check`, {
            method: 'POST',
            body: JSON.stringify({ username, password }),
            headers: new Headers({ 'Content-Type': 'application/json' }),
        })
        return fetch(request)
            .then(response => {
                console.log(response);
                if (response.status < 200 || response.status >= 300) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .then(({ token, data }) => {
                localStorage.setItem('token', token);
                localStorage.setItem('role', data.role);
                localStorage.setItem('userId', data.id);
                localStorage.setItem('store', data.store);
            });
    },
    logout: params => {
        localStorage.removeItem('token');
        localStorage.removeItem('role');
        localStorage.removeItem('userId');
        localStorage.removeItem('store');
        return Promise.resolve();
    },
    checkError: error => {
        // ...
    },
    checkAuth: () => {
        return localStorage.getItem('token') ? Promise.resolve() : Promise.reject();
    },
    getPermissions: params =>  {
        const role = localStorage.getItem('role');
        const userId = localStorage.getItem('userId');
        const store = localStorage.getItem('store');
        const permissions = { role, userId, store };
        return permissions ? Promise.resolve(permissions) : Promise.reject();
    },
}


export default authProvider;

