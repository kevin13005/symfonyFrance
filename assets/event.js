
    const close = document.getElementsByClassName('btn-close');
    const alertNode = document.querySelector('.alert');
    var alert = bootstrap.Alert.getInstance(alertNode);
    close.addEventListener("click", () => {
    
    
    alert.close();
    console.log('oui');

});
    
    
    