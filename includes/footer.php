<!-- tinymce initialization -->
<script>
    tinymce.init({
        selector: '.tinymce_inputfield',
        plugins: [
            'a11ychecker', 'autolink',
            'lists', 'link', 'charmap', 'preview', 'anchor', 'visualblocks',
            'powerpaste', 'fullscreen', 'insertdatetime', 'table', 'wordcount'
        ],
        height: '500px',
        toolbar_sticky: true,
        icons: 'thin',
        autosave_restore_when_empty: true,
        toolbar: 'undo redo |  blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | removeformat | table ',
        convert_newline_to_brs: true
    });
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>