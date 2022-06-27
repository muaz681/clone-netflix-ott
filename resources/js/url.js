import axios from 'axios'

axios.create({
    baseURL: process.env.appUrl
});