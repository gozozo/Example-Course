import axios from "./ClientWS.js";

export default class InstruictorWS {
    static get() {
        return axios.instance().get('/api/v1/instructor')
    }
    static show(id) {
        return axios.instance().get('/api/v1/instructor/'+id)
    }
}