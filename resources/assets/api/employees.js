

const employees = {

	view(cb,errorCb){
		axios.get(API_URL+ '/employees')
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error =>{
			console.log(error);
			 errorCb(error); //.resp.data
		});
	},

	add(data, cb,errorCb){
		axios.post(API_URL+ '/employees', data)
		.then(resp => {
			if (resp.status == 201) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error =>{
			console.log(error);
			 errorCb(error); //.resp.data
		});
	},
	get_single(id, cb,errorCb){
		axios.get(API_URL+ '/employees/'+id)
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data)
			}
		}).catch(error =>{
			 errorCb(error); //.resp.data
		});
	},

	update(id,data, cb,errorCb){
		axios.put(API_URL+ '/employees/'+id, data)
		.then(resp => {
			console.log(resp);
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data)
			}
		}).catch(error =>{
			// console.log(error);
			 errorCb(error); //.resp.data
		});
	},
	delete(id,cb,errorCb){
		axios.delete(API_URL+ '/employees/'+id)
		.then(resp => {
			console.log(resp);
			if (resp.status == 204) {
				cb(resp);
			}else{
				errorCb(resp)
			}
		}).catch(error =>{
			// console.log(error);
			 errorCb(error); //.resp.data
		});
	},

	verify_code(code, cb, errorCb){
		axios.post(API_URL+ '/employee_verify', {code: code})
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error => {
			errorCb(error);
		});	
	},

	create_profile(data, cb,errorCb){
		axios.post(API_URL+ '/create_profile', data)
		.then(resp => {
			if (resp.status == 201) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(error => {
			errorCb(error);
		});	
	},
	clock_in(data, cb, errorCb){
		axios.post(API_URL+'/clock_in',data)
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(err =>{
			console.log(err);
		});
	},

	clock_out(data, cb, errorCb){
		axios.post(API_URL+'/clock_out',data)
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(err =>{
			console.log(err);
		});
	},

	break_in(data, cb, errorCb){
		axios.post(API_URL+'/break_in',data)
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(err =>{
			console.log(err);
		});
	},
	break_out(data, cb, errorCb){
		axios.post(API_URL+'/break_out',data)
		.then(resp => {
			if (resp.status == 200) {
				cb(resp.data);
			}else{
				errorCb(resp.data);
			}
		}).catch(err =>{
			console.log(err);
		});
	},
}
export default employees;

