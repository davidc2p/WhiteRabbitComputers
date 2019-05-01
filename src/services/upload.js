import axios from 'axios'
import { Api } from './Api.js'

export default function(file, name = 'avatar') {
    if (typeof name !== 'string') {
        throw new TypeError(`Expected a string, got ${typeof name}`);
    }

    const formData = new FormData();
    formData.append(name, file);
    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
    };
    return Api.post('upload/index.php', formData, config);
};