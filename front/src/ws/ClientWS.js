import axios from "axios";

const instance = axios.create({
    baseURL: 'http://local.stanbridge.test'
});

export default class ClientWS {
    static instance() {
        return instance;
    }
}
