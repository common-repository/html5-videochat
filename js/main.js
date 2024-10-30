(function() {
    tinymce.create('tinymce.plugins.button_html5_videochat', {
        init : function(ed, url) {
            var image = url+'/icon-btn-editor.png';

            ed.addButton('btn_html5_videochat', {
                title : 'Insert HTML5 videochat',
                cmd : 'insert_html5_videochat',
                class: 'html5_button_editor',
                image : image
            });

            ed.addCommand('insert_html5_videochat', function() {
                var selected_text = ed.selection.getContent();
                ed.execCommand('mceInsertContent', 0, '[HTML5VIDEOCHAT width=100% height=640px]');
            });
        },

        createControl : function(n, cm) {
            return null;
        }
    });

    tinymce.PluginManager.add('button_html5_videochat', tinymce.plugins.button_html5_chat);
})();