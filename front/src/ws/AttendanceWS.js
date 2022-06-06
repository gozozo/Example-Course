import axios from "./ClientWS.js";

export default class AttendanceWS {

    static store(data) {
        return axios.instance().post('/api/v1/attendance', data)
    }

    static delete(id) {
        return axios.instance().delete('/api/v1/attendance/'+id)
    }
}