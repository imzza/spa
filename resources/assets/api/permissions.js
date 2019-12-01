const permissions = {
    view_permisions(cb, errorCb) {
        axios
            .get(API_URL + '/permissions')
            .then(resp => {
                if (resp.status == 200) {
                    cb(resp.data);
                } else {
                    errorCb(resp.data);
                }
            })
            .catch(error => {
                console.log(error);
                errorCb(error); // .resp.data
            });
    },
    permission_by_group(cb, errorCb) {
        axios
            .get(API_URL + '/permission_by_group')
            .then(resp => {
                if (resp.status == 200) {
                    cb(resp.data);
                } else {
                    errorCb(resp.data);
                }
            })
            .catch(error => {
                console.log(error);
                errorCb(error); // .resp.data
            });
    },
    permission_by_role(id, cb, errorCb) {
        axios
            .get(API_URL + '/permission_by_role/' + id)
            .then(resp => {
                if (resp.status == 200) {
                    cb(resp.data);
                } else {
                    errorCb(resp.data);
                }
            })
            .catch(error => {
                errorCb(error); // .resp.data
            });
    },

    add_role(data, cb, errorCb) {
        axios
            .post(API_URL + '/roles', data)
            .then(resp => {
                if (resp.status == 201) {
                    cb(resp.data);
                } else {
                    errorCb(resp.data);
                }
            })
            .catch(error => {
                console.log(error);
                errorCb(error); // .resp.data
            });
    },
    get_role(id, cb, errorCb) {
        axios
            .get(API_URL + '/roles/' + id)
            .then(resp => {
                console.log(resp);
                if (resp.status == 200) {
                    cb(resp.data);
                } else {
                    errorCb(resp.data);
                }
            })
            .catch(error => {
                // console.log(error);
                errorCb(error); // .resp.data
            });
    },

    update_role(id, data, cb, errorCb) {
        axios
            .put(API_URL + '/roles/' + id, data)
            .then(resp => {
                console.log(resp);
                if (resp.status == 200) {
                    cb(resp.data);
                } else {
                    errorCb(resp.data);
                }
            })
            .catch(error => {
                // console.log(error);
                errorCb(error); // .resp.data
            });
    },
    delete_role(id, cb, errorCb) {
        axios
            .delete(API_URL + '/roles/' + id)
            .then(resp => {
                console.log(resp);
                if (resp.status == 204) {
                    cb(resp);
                } else {
                    errorCb(resp);
                }
            })
            .catch(error => {
                // console.log(error);
                errorCb(error); // .resp.data
            });
    },
};
export default permissions;

// if(error.response.status == 422 && typeof error.response.data == "object" && error.response.data)
// {
// $.each(error.response.data, function(field, messages) {
// this.errors.add(field, messages[0]);
// });
// }
