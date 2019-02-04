export default () => {
    return axios.create({
        baseURL: `./ajax/`,
        withCredentials: false,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
}