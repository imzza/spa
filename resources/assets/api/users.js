const roles = {
    view(cb, errorCb) {
        axios
            .get(API_URL + '/profile')
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

    // add(data, cb,errorCb){
    // 	axios.post(API_URL+ '/corporations', data)
    // 	.then(resp => {
    // 		if (resp.status == 201) {
    // 			cb(resp.data);
    // 		}else{
    // 			errorCb(resp.data);
    // 		}
    // 	}).catch(error =>{
    // 		console.log(error);
    // 		 errorCb(error); //.resp.data
    // 	});
    // },
    get_single(cb, errorCb) {
        axios
            .get(API_URL + '/profile/')
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

    update(data, cb, errorCb) {
        // console.log(id);
        axios
            .post(API_URL + '/profile', data)
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
    // delete(id,cb,errorCb){
    // 	axios.delete(API_URL+ '/corporations/'+id)
    // 	.then(resp => {
    // 		console.log(resp);
    // 		if (resp.status == 204) {
    // 			cb(resp);
    // 		}else{
    // 			errorCb(resp)
    // 		}
    // 	}).catch(error =>{
    // 		// console.log(error);
    // 		 errorCb(error); //.resp.data
    // 	});
    // },
};
export default roles;

// if(error.response.status == 422 && typeof error.response.data == "object" && error.response.data)
// {
// $.each(error.response.data, function(field, messages) {
// this.errors.add(field, messages[0]);
// });
// }
