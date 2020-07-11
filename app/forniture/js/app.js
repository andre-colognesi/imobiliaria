function callToast(message,type,callback){
    let bgColor;
    if(type == 'success'){
        bgColor =  "#33cc33"
    }else if(type == 'warning'){
        bgColor = '#e6e600'
    }else if(type == "danger"){
        bgColor = "#ff9980";
    }
        let Toast = Toastify({
      text: message,
      duration: 5000,
      backgroundColor: bgColor
    });
    
    Toast.showToast();
}