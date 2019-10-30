

const roles = {

	view_roles(cb,errorCb){
		axios.get(API_URL+ '/roles')
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error =>{
			errorCb(error);
		});
	},

	add_role(data, cb,errorCb){
		axios.post(API_URL+ '/roles', data)
		.then(resp => {
			if (resp.status == 201) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error =>{
			errorCb(error);
		});
	},
	get_role(id, cb,errorCb){
		axios.get(API_URL+ '/roles/'+id)
		.then(resp => {
			console.log(resp);
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data)
			}
		}).catch(error =>{
			errorCb(error);
		});
	},

	update_role(id,data, cb,errorCb){
		axios.put(API_URL+ '/roles/'+id, data)
		.then(resp => {
			console.log(resp);
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data)
			}
		}).catch(error =>{
			errorCb(error);
		});
	},
	delete_role(id,cb,errorCb){
		axios.delete(API_URL+ '/roles/'+id)
		.then(resp => {
			console.log(resp);
			if (resp.status == 204) {
				cb(resp);
			}else{
				errorCb(resp)
			}
		}).catch(error =>{
			errorCb(error);
		});
	},
	assign_permissions(id,data, cb,errorCb){
		axios.post(API_URL+ '/roles_assign_permissions', { id: id, permissions: data})
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error =>{
			errorCb(error);
		});
	},
	view_permissions(cb,errorCb){
		axios.get(API_URL+ '/all_permissions')
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error =>{
			errorCb(error);
		});
	},
	add_permission(data, cb,errorCb){
		axios.post(API_URL+ '/permissions', data)
		.then(resp => {
			if (resp.status == 201) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error =>{
			errorCb(error);
		});
	},
	get_permission(id, cb,errorCb){
		axios.get(API_URL+ '/permissions/'+id)
		.then(resp => {
			console.log(resp);
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data)
			}
		}).catch(error =>{
			errorCb(error);
		});
	},

	update_permission(id,data, cb,errorCb){
		axios.put(API_URL+ '/permissions/'+id, data)
		.then(resp => {
			console.log(resp);
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data)
			}
		}).catch(error =>{
			errorCb(error);
		});
	},
	delete_permission(id,cb,errorCb){
		axios.delete(API_URL+ '/permissions/'+id)
		.then(resp => {
			console.log(resp);
			if (resp.status == 204) {
				cb(resp);
			}else{
				errorCb(resp)
			}
		}).catch(error =>{
			errorCb(error);
		});
	},
}
export default roles;


// if(error.response.status == 422 && typeof error.response.data == "object" && error.response.data)
// {
// $.each(error.response.data, function(field, messages) { 
// this.errors.add(field, messages[0]); 
// });
// }


