const authProvider = {
    login: ({ username, password }) => {
        const request = new Request(`${process.env.REACT_APP_API_ENDPOINT}/login_check`, {
            method: 'POST',
            body: JSON.stringify({ username, password }),
            headers: new Headers({ 'Content-Type': 'application/json' }),
        })
        return fetch(request)
            .then(response => {
                if (response.status < 200 || response.status >= 300) {
                    throw new Error('Une erreur est survenue, veuillez réessayer plus tard.');
                }
                return response.json();
            })
            .then(({ token, data }) => {
                if(!data.active){
                    throw new Error("Cet utilisateur est inactif, veuillez valider votre email");
                }
                localStorage.setItem('token', token);
                localStorage.setItem('role', data.role);
                localStorage.setItem('store', data.store);
                localStorage.setItem('userId', data.userId);
            });
    },
    logout: params => {
        localStorage.removeItem('token');
        localStorage.removeItem('role');
        localStorage.removeItem('store');
        localStorage.removeItem('userId');

        return Promise.resolve();
    },
    checkError: error => {
    },
    checkAuth: () => {
        return localStorage.getItem('token') ? Promise.resolve() : Promise.reject();
    },
    getPermissions: params =>  {
        const role = localStorage.getItem('role');
        const store = localStorage.getItem('store');
        const userId = localStorage.getItem('userId');
        const permissions = { role, store, userId };
        return permissions ? Promise.resolve(permissions) : Promise.reject();
    },
}


export default authProvider;

