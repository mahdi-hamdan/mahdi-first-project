
$(document).ready(function(){

    list();
  list2();
});
var table1;
var list=function() {
    table1 = $('#table_Album').DataTable({
"destroy":true,
        "ajax": '/index/viewalbums',
        "columns": [
            {"data": "id"},
            {"data": "artist_id"},
            {"data": "artist_name"},
            {"data": "title"},
            {"data": "id",
                "render":function (data, type, row) {
                    return '<button   data-id="' + data + '" class="editAlbum btn btn-primary">Edit</button> <button  data-id="' + data + '"   class="deleteAlbum  btn btn-primary">delete</button>'  ;
                }
            }

        ]
    });

}
var table2;
var list2=function() {
    table2 = $('#table_Artist').DataTable({
        "destroy":true,
        "ajax": '/artist/viewartist',
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {"data": "address"},
            {"data": "title"},
            {"data": "id",
                "render":function (data, type, row) {
                    return '<button   data-id="' + data + '" class="edit_artist btn btn-primary">Edit</button> <button  data-id="' + data + '"   class="delete_artist  btn btn-primary">delete</button>'  ;
                }
            }

        ]
    });

}
    $('#add_albums').on('click', function(e) {

        e.preventDefault(e);
        $('#addModal .modal-body > div').load('/index/add/isajax/1');

        $('#addModal').modal();
    });

    $('#submit_addalbum').on('click',function(e){

        var artist =$('#artistlistid').val();
        var title =$('#titleid').val();
        $.ajax({
                url:"/index/add/",
                type:"POST",
                data :{
                    "artist":artist,
                    "title":title
                },
                success :function(data){
                    table1.ajax.reload();
                    $('#addModal').modal('hide');
                }
            }
        );
    });


    $('#submit_editalbum').on('click',function(e){

        var id = $('#idofalbum').val();
        var artist =$('#artistlistid').val();
        var title =$('#titleid').val();

        $.ajax({
                url:"/index/edit/",
                type:"POST",
                data :{
                    "id":id,
                    "artist":artist,
                    "title":title
                },
                success :function(data){
                    table1.ajax.reload();


                    $('#editModal').modal('hide');
                }
            }
        );
    });

$(document).on('click','.editAlbum',function(){
    var idoofalbum=$(this).data("id");
    $('#editModal .modal-body > div').load('/index/edit/id/'+idoofalbum);
    $('#editModal').modal();

});
    var idoofalbum;
$(document).on('click','.deleteAlbum',function(){

        idoofalbum=$(this).data("id");
        $('#deleteModal .modal-body > div').load('/index/delete/id/'+idoofalbum);

        $('#deleteModal').modal();
    });


    $('#Delete_album').on('click', function(e) {

        e.preventDefault(e);
        $.ajax({
                url:"/index/delete/",
                type:"POST",
                data :{
                    "id":idoofalbum,
                    "del":'Yes'
                },
                success :function(data){
                    table1.ajax.reload();
                    $('#deleteModal').modal('hide');
                }
            }
        );
    });



    $('#add_artist').on('click', function(e) {

        e.preventDefault(e);
        $('#add_artistModal .modal-body > div').load('/artist/add/isajax/1');

        $('#add_artistModal').modal();
    });


    $('#submit_add_artist').on('click',function(e){

        var name =$('#artist_name').val();
        var address =$('#artist_address').val();
        $.ajax({
                url:"/artist/add/",
                type:"POST",
                data :{
                    "name":name,
                    "address":address
                },
                success :function(data){
                    table2.ajax.reload();
                    $('#add_artistModal').modal('hide');
                }
            }
        );
    });



$(document).on('click','.edit_artist',function(){

        var idoofalbum=$(this).data("id");
        $('#edit_artist_Modal .modal-body > div').load('/artist/edit/id/'+idoofalbum);

        $('#edit_artist_Modal').modal();
    });
    $('#submit_edit_artist').on('click',function(e){

        var id = $('#artist_id').val();
        var name =$('#artist_name').val();
        var address =$('#artist_address').val();

        $.ajax({
                url:"/artist/edit/",
                type:"POST",
                data :{
                    "id":id,
                    "name":name,
                    "address":address
                },
                success :function(data){
                    table2.ajax.reload();
                    $('#edit_artist_Modal').modal('hide');
                }
            }
        );
    });
    var idofartist;
$(document).on('click','.delete_artist',function(){

        idofartist=$(this).data("id");
        $('#delete_artist_Modal .modal-body > div').load('/artist/delete/id/'+idofartist);

        $('#delete_artist_Modal').modal();
    });
    $('#Delete_artist').on('click', function(e) {

        e.preventDefault(e);
        $.ajax({
                url:"/artist/delete/",
                type:"POST",
                data :{
                    "id":idofartist,
                    "del":'Yes'
                },
                success :function(data){
                    table2.ajax.reload();
                    $('#delete_artist_Modal').modal('hide');
                }
            }
        );
    });




