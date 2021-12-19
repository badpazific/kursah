jQuery(function($) {
  $(document).on('submit', '#login_form', function(){
  // получаем данные формы 
  var login_form=$(this);
  var form_data=JSON.stringify(login_form.serializeObject());

  // отправить данные формы в API 
  $.ajax({
      url: "login.php",
      type : "POST",
      contentType : 'application/json',
      data : form_data,
      success : function(result){

          // сохранить JWT в куки 
          setCookie("jwt", result.jwt, 1);

          $('#response').html("<div class='alert alert-success'>Успешный вход в систему.</div>");

      },
      error: function(xhr, resp, text){
          // при ошибке сообщим пользователю, что вход в систему не выполнен и очистим поля ввода 
          $('#response').html("<div class='alert alert-danger'>Ошибка входа. Email или пароль указан неверно.</div>");
      }
    });
    return false;
  });
  // функция setCookie() поможет нам сохранить JWT в файле cookie 
  function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' '){
              c = c.substring(1);
          }

          if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
          }
      }
      return "";
    }

    // serializeObject функция для преобразования значений формы в формат JSON 
    $.fn.serializeObject = function(){
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    // Отправка данных с формы в бд для создания аккаунта
    $(document).on('submit', '#sign_up_form', function(){
        // получаем данные формы 
        var sign_up_form=$(this);
        var form_data=JSON.stringify(sign_up_form.serializeObject());

        // отправить данные формы в API 
        $.ajax({
            url: "reg.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                // в случае удачного завершения запроса к серверу, 
                // сообщим пользователю, что он успешно зарегистрировался и очистим поля ввода 
               $('#response').html("<div class='alert alert-success'>Успешная регистрация пользователя</div>");
            },
            error: function(xhr, resp, text){
                // при ошибке сообщить пользователю, что регистрация не удалась 
                $('#response').html("<div class='alert alert-danger'>Ошибка регистрации.</div>");
            }
        });

        return false;
    });
  // Показать лекарства
  $(document).on('click', '.btn-primary', function(){
    var html = `
        <!-- Лекарства -->
            <div id="medlist">
                <?php 
                  require_once('dblek.php');
                ?>
            </div>
        <!-- Лекарства -->
    `;
  $('#med_show').html(html);
  });

  });