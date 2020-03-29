const baseURL = pm.variables.get("baseURL");

const echoPostRequest = {
  url: `${baseURL}/login`,
  method: 'POST',
  header: 'Content-Type:application/json',
  body: {
    mode: 'application/json',
    raw: JSON.stringify(
        {
          email:'admin@admin.com',
          password:'admin',
        })
  }
};

pm.sendRequest(echoPostRequest, function (err, res) {
console.log(err ? err : res.json());
    if (err === null) {
        console.log('Saving the token and expiry date')
        var responseJson = res.json();
        pm.environment.set('accessToken', responseJson.token)
    }
});
