@extends('layout.app')

@section('title','Home')


@section('content')
  <div class="container-fluid mt-5">
    <div class="row d-flex justify-content-left ml-5">
      <div class="col-md-4 mt-5">
        <div class="card text-center">
          <div class="card-header">
            <h4>Laravel Axios Multipul File Uploader</h4>
          </div>
          <div class="card-body p-3">
              {{--<form action="{{route('filesave')}}" method="post" enctype="multipart/form-data">--}}
                  {{--@csrf--}}

            <input id="FileID" class="form-control my-3" name="FileKey" type="file">
            <button type="button" onclick="onUploadFile()" id="UploadBtnID" class="btn my-3 btn-block btn-primary">upload</button>
              {{--</form>--}}
                  <h6 id="uploadByMb"></h6>
        </div>

      </div>
    </div>

        <div class="col-md-4 card text-center p-3 m-4">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>No</td>
                    <td>Download</td>
                </tr>
                </thead>

                <tbody class="tableData">
                <tr>
                    <td></td>
                    <td></td>
                </tr>

                </tbody>
            </table>

        </div>

  </div>
  </div>

@endsection

@section('script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

   <script type="text/javascript" >

       getFileList();
       function getFileList(){
           axios.get('/fileList').then(function (response) {
               var jsondata=  response.data;
               $.each(jsondata,function (i) {
                   $('<tr>').html(
                           `<td>${jsondata[i].id}</td>
                            <td><a href="${jsondata[i].file_path}" class="btn  btn-primary">Download</a></td>`
                   ).appendTo('.tableData');
               })
           }).catch(function (error) {
           })
       }



    function onUploadFile(){

        var myFile= document.getElementById('FileID').files[0];
        var myFileName=myFile.name;
        var myFileSize=myFile.size;
        var FileFormat=myFileName.split('.').pop();

        var FileData= new FormData();
        FileData.append('FileKey',myFile);

        var config={
            header:{'content-type': 'multipart/form-data'},
            onUploadProgress:function(progressEvent){
                //var uploadPercentage= Math.round((progressEvent.loaded*100)/progressEvent.total)

                var UploadedMb=(progressEvent.loaded)/(1028*1028);
                var TotalMb=(progressEvent.total)/(1028*1028);
                var LeftMb=TotalMb-UploadedMb;
                  $('#uploadByMb').html("Uploaded: "+UploadedMb.toFixed(2)+ " LeftMb: "+LeftMb.toFixed(2)+ " TotalMb: "+TotalMb.toFixed(2))
            }

        };

        var url='/fileUp';


        axios.post(url,FileData,config)
                .then(function (response) {
                    if(response.status==200){
                        $('#uploadByMb').html('file upload success');

                        setTimeout(function() {
                            $('#uploadByMb').html('') ;
                        },2000)

                    }else{
                        $('#uploadByMb').html('file  Fail');
                        setTimeout(function() {
                            $('#uploadByMb').html('');
                        },2000)
                    }
                   
                }).catch(function (error) {
                           // console.log(error);
                       $('#uploadByMb').html('file upload Fail');
                            setTimeout(function () {
                                $('#uploadByMb').html('');
                            },2000)

        })

    }

  </script>

@endsection
