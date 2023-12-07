// import EditorJS from '@editorjs/editorjs';

const saveButton = document.getElementById('editorjs-btn-save');
const output = document.getElementById('editorjs-output');
const frm = document.getElementById('editorjs-frm');

const editor = new EditorJS({
    /**
    * Id of Element that should contain Editor instance
    */
    holder: 'editorjs',
    autofocus: true,
    tools: {
        paragraph: {
            class: Paragraph,
            inlineToolbar: true,
            config: {
                placeholder: 'Paragraf teksta'
            }            
        },

        header: {
            class: Header,
            config: {
                placeholder: 'Naslov',
                levels: [2, 3, 4, 5, 6],
                defaultLevel: 2
            }
        },
        
        list: {
            class: List,
            inlineToolbar: true,
            config: {
                defaultStyle: 'unordered' // type of a list: ordered or unordered
            }
        },   
    
        quote: {
            class: Quote,
            inlineToolbar: true,
            config: {
                quotePlaceholder: 'Upišite citat',
                captionPlaceholder: 'Autor ili Izvor citata',
            },
        },        

        table: Table,

        spacer: Spacer,

        delimiter: Delimiter,  
        
        // attaches: {
        //     class: AttachesTool,
        //     config: {
        //         endpoint: '/admin/api/Forms/EditorUploadFile/lvd43sdfgjow9skd9f',
        //         field: 'files[]',
        //         buttonText: 'Datoteka',
        //         errorMessage: 'Došlo je do pogreške. Datoteka nije prenesena na poslužitelj'
        //     }
        // },

        image: {
            class: ImageTool,
            config: {
                endpoints: {
                    byFile: '/admin/api/Forms/EditorUploadImage/lvd43sdfgjow9skd9f', // Your backend file uploader endpoint
                },
                field: 'files[]',
                buttonContent: 'Slika',
                captionPlaceholder: 'Opis slike'
            }
        },
    
    },

    /**
     * Previously saved data that should be rendered
     */
    data: JSON.parse(output.value),

    /**
    * Internationalzation config
    */
    i18n: {
        messages: {
            toolNames: {
                "Text": "Tekst",
                "Heading": "Naslov",
                "List": "Lista",
                "Quote": "Citat",
                "Table": "Tablica",
                "Link": "Poveznica",
                "Attachment": "Datoteka",
                "Image": "Slika"
            }
        }       
    },
    
   /**
    * onReady callback
    */
    onReady: () => {
        console.log('Editor.js je spreman za rad!');
    },    
});

saveButton.addEventListener('click', () => {
    editor.save().then( savedData => {
        output.innerHTML = JSON.stringify(savedData, null, 4);
        frm.submit();
    })
})
