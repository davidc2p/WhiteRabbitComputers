import axios from 'axios'

export const Api = axios.create({
    //baseURL: `http://127.0.0.1:8080/Vue/WhiteRabbitComputers/public/ajax/`,
    //baseURL: `http://whiterabbitcomputers.eu3.org/ajax/`,
    baseURL: process.env.VUE_APP_BASE_URI,
    withCredentials: false,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
})