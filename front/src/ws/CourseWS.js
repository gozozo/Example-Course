import axios from "./ClientWS.js";

export default class CorseWS {
    static show(id) {
        return axios.instance().get('/api/v1/course/'+id)
    }
}