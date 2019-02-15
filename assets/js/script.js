window.onload = function () {

    tinymce.init({  selector:'#menuitems-content',
                    height: 300,
                    theme: 'modern',
		    menubar: false,
                    plugins: [
                        'lists link image',
                    ],
                    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | lists link image',
                    });

    let filter = $('#menuFilter');
    let drag = $('.drag');
    var oldContainer;

    if(filter.length!=0){
        filter.change(function () {
            location.replace(`/menu/items/${$(this).find('option:selected').val()}`);
        })
    }



    if(drag.length!=0){
        drag.sortable({
            //group: 'drag',
            //flag : true,
            //containerSelector : 'ul',
            itemSelector : 'li',
            placeholder : '<li class="placeholder"></li>',
            distance: 1,

            afterMove: function (placeholder, container) {
                if(oldContainer != container){
                    if(oldContainer)
                        oldContainer.el.removeClass("active");
                    container.el.addClass("active");

                    oldContainer = container;
                }
            },

            onDrop: function ($item, container, _super) {
                if(!this.flag){
                    let sendButton = $('<span id="sendSort"></span>').text('Сохранить порядок').addClass('btn btn-danger');
                    sendButton.click(sendData)
                    $('.buttons:eq(0)').append(sendButton);
                }
                container.el.removeClass("active");

                _super($item, container);
                this.flag = true;

                function sendData(dataJson) {
                    console.log(JSON.stringify(drag.sortable("serialize").get(), null, ' '));
                    $.ajax({
                        url : "/menu/items/sort",
                        data: {
                            json : JSON.stringify(drag.sortable("serialize").get(), null, ' ')
                        },
                        success : function (data) {
                            //console.log(data)
                            if(data.status) {
                                $("#message").removeClass('hide').text('Порядок сохранен');
                                setTimeout(function () {
                                    $("#message").addClass('hide').text('');
                                },4000)
                            }
                        }
                    })
                }
            }
        });
    }


}