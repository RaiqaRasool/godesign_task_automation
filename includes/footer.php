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
</body>

</html>