const helper = {
    getMessage(error, vm) {
        if (error.response.status == 422 && typeof error.response.data === 'object' && error.response.data) {
            // $.each(error.response.data, function(field, messages) {
            // this.errors.add(field, messages[0]);
            // });
            error.response.dataerrors.forEach((el, ind) => {
                console.log('el');
            });
        }
    },
};

export default helper;
