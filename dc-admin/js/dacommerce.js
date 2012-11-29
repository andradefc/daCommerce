$(function() {
    $('table.da-table thead tr th input[type=checkbox]').click(function() {
        if ($(this).is(':checked')){
            $('tbody input[type=checkbox]', $(this).parents('table.da-table')).attr('checked', 'checked');
        }else{
            $('tbody input[type=checkbox]', $(this).parents('table.da-table')).removeAttr('checked');
        }
    });

    $('form.da-form input#search-user').keyup(function(e) {
        mostra = false;
        conttd = $('table.da-table tbody tr').first().children('td').length;

        /* Recebe valor do input */
        valor = $(this).val();
        $('table.da-table tbody tr').hide();

        /* Da loop em todos itens da lista */
        $('table.da-table tbody tr td').each(function() {
          valor_li = $(this).text();

          /* Cria uma ER para procurar nos itens */
          reg = valor;
          er = new RegExp("(.*)(" + reg + ")(.*)", "i");

          /* Executa a ER */
          if (er.exec(valor_li)){
            $(this).parent('tr').show();
            mostra = true;
          }
        });

        if (!mostra) {
          $('tr.error').remove();
          $('table.da-table tbody').append('<tr class="error"><td style="text-align:left" colspan="'+conttd+'">Nada encontrado</td></tr>');
        }else{
          $('tr.error').remove();
        }
    });

    $('a.change-action').click(function() {
      $('#form-table').attr('action', $(this).attr('href'));
      $('#form-table').submit();
      return false;
    });

    setTimeout(function() {
      $('.da-message').slideUp(500);
      $('tr.new td').animate({backgroundColor: "#333"}, 300)
    }, 2000);

    $("form.user-form").validate({
        rules: {
            user_name: {
                required: true
            },
            user_email: {
                required: true,
                email: true
            },
            user_pass: {
                required: true
            }
        },
        messages: {
            user_name: 'Digite um nome para o usuário',
            user_email: 'Digite um e-mail válido',
            user_pass: 'Digite uma senha para o usuário'
        }
    });

    $("#uploader").pluploadQueue({
        // General settings
        runtimes : 'gears,silverlight,browserplus,html5',
        url : 'upload.php',
        max_file_size : '10mb',
        chunk_size : '1mb',
        unique_names : true,

        // Resize images on clientside if we can
        resize : {width : 800, height : 600, quality : 70},

        // Specify what files to browse for
        filters : [
          {title : "Image files", extensions : "jpg,gif,png"},
          {title : "Zip files", extensions : "zip"}
        ],

        // Flash settings
        flash_swf_url : '/plupload/js/plupload.flash.swf',

        // Silverlight settings
        silverlight_xap_url : '/plupload/js/plupload.silverlight.xap'
    });

    // Client side form validation
    $('form.da-form.product-form').submit(function(e) {
        var uploader = $('#uploader').pluploadQueue();

        // Files in queue upload them first
        if (uploader.files.length > 0) {
            // When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    $('form.da-form.product-form')[0].submit();
                }
            });

            uploader.start();
        } else {
            // alert('Você precisa inserir pelo menos um arquivo de imagens.');
            $('form.da-form.product-form')[0].submit();
        }

        return false;
    });
});