function uploadAjax(){
    var inputFileImage = document.getElementById('archivoImage');
    var file = inputFileImage.files[0];
    var data = new FormData();
    var a= $('#a').val();
    data.append('archivo',file);
    $.ajax({
        url:'in.php?as='+a,
        type:'POST',
        contentType:false,
        data:data,
        processData:false, 
        cache:false,
        beforeSend: function () {
        },
        success: function (response) {
            alert(response);
        }
    });
}