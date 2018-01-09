<script>
      var APP_URL = {!! json_encode(url('/')) !!}

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var table = $('#table').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
                url: '{{route('serverSideProduct')}}',
                type: "POST",
          },
          columnDefs: [{
              targets: [0, 1, 2],
              className: 'mdl-data-table__cell--non-numeric'
          }],
          columns: [
              {data: 'rownum', name: 'rownum'},
              {data: 'product_name', name: 'product_name'},
              {data: 'product_image', name: 'product_image'},
              {data: 'product_detail', name: 'product_detail'},
              {data: 'product_cost_price', name: 'product_cost_price'},
              {data: 'product_sale_price', name: 'product_sale_price'},
              {data: 'product_quantity', name: 'product_quantity'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
          ],
      });

      $(document).on('click', '.edit-modal', function() {
           $('.error').addClass('hidden');
           $('.update-sucess').css("display","none");
           $('.create-sucess').css("display","none");
           $('.modal-dialog').css("margin-top","120px");
           $('.delete-sucess').hide();
           $('.actionBtn').show();
           $('.form-group').show();
           $('#footer_action_button').text(" Update");
           $('#footer_action_button').addClass('glyphicon-check');
           $('#footer_action_button').removeClass('glyphicon-trash');
           $('.actionBtn').addClass('btn-success');
           $('.actionBtn').removeClass('btn-danger');
           $('.actionBtn').removeClass('create');
           $('.actionBtn').removeClass('delete');
           $('.actionBtn').removeClass('create-new-product');
           $('.actionBtn').addClass('edit');
           $('.modal-title').text('แก้ไข ข้อมูลสินค้า');
           $('.deleteContent').hide();
           $('.form-horizontal').show();
           var details = $(this).data('info').split(',');
           fillmodalData(details);
           $('#myModal').modal('show');
           $('.form-group').removeClass('hidden');
       })

       // fillmodalData ใส่ข้อมูลที่ user ต้องการ edit ลงไปใน madal ฟอร์ม
        function fillmodalData(details){
           var img= $(".pimage img:first");
           img.attr("src",APP_URL+"/pic/"+details[0]);
           $('#pid').val(details[0]);
           $('#pname').val(details[1]);
           $('#pdetail').val(details[2]);
           $('#pcost').val($.trim(details[3]));
           $('#psale').val(details[4]);
           $('#pquantity').val(details[5]);
         }

         //when the use click on edit button it will be updated new information to the database
          $('.modal-footer').on('click', '.edit', function(){
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
               });

               var formData = new FormData($("#productForm")[0]);

               $.ajax({
                   type:'POST',
                   processData: false,
                   contentType: false,
                   url: '/editProduct',
                   data: formData,
                   success: function(data){
                      alert("success"+data.errors);
                      if(data.errors){
                           $('#myModal').modal('show');
                           $('update-sucess').remove();
                           if(data.errors.pname) {
                               $('.pname_error').removeClass('hidden');
                               $('.pname_error').text("ชื่อ ไม่สามารถเว้นว่างไว้ได้ และ เป็นตัวอักษรเท่านั้น โปรด ระบุชื่อ");
                           }
                           if(data.errors.pphoto) {
                               $('.pphoto_error ').removeClass('hidden');
                               $('.pphoto_error').text("ไฟล์รูปภาพต้องเป็นนามสกุล jpeg, jpg, png, gif เท่านั้น");
                           }
                           if(data.errors.pdetail) {
                               $('.pdetail_error').removeClass('hidden');
                               $('.pdetail_error').text("ที่อยู่ ไม่สามารถเว้นว่างไว้ได้ โปรด ระบุที่อยู่");
                           }
                           if(data.errors.pcost) {
                               $('.pcost_error').removeClass('hidden');
                               $('.pcost_error').text("โปรดใส่ราคาต้นทุน เป็นค่าตัวเลขเท่านั้น");
                           }
                           if(data.errors.psale) {
                               $('.psale_error').removeClass('hidden');
                               $('.psale_error').text("โปรดใส่ราคาขาย เป็นค่าตัวเลขเท่านั้น");
                           }
                           if(data.errors.pquantity) {
                               $('.pquantity_error').removeClass('hidden');
                               $('.pquantity_error').text("โปรดใส่จำนวนสินค้า เป็นตัวเลขเท่านั้น");
                           }
                       }
                       //else {
                       //      // table.ajax.reload();
                       //      // $('.error').addClass('hidden');
                       //      // $('#myModal').modal('show');
                       //      // $('.update-sucess').css("display","block");
                       // }
                   }
               });
            });
</script>
