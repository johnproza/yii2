window.onload = function () {

    tinymce.init({  selector:'#menuitems-content',
                    height: 300,
                    theme: 'modern',
                    plugins: [
                        'lists link image',
                    ],
                    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | lists link image',
                    });
}