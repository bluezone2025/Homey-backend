$(function() {

    /////////////////////////////// start plugins  //////////////////////////
    ////////////////////////////////////////////////////////////////////////


    // $('input:not[checkbox]').maxlength({
    //     threshold: 40,
    // });

    let body = $('body');
    var firstUpload = new FileUploadWithPreview('myFirstImage')

    var secondUpload = new FileUploadWithPreview('gallery')

    ClassicEditor
        .create( document.querySelector( '#description_ar' ) )
        .then( editor => {
        console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#description_en' ) )
        .then( editor => {
        console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );


    ClassicEditor
        .create( document.querySelector( '#about_brand_ar' ) )
        .then( editor => {
        console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#about_brand_en' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );

    /*tinymce.init({
        selector: '#description_ar, #description_en, #about_brand_ar, #about_brand_en',

        directionality: "ltr",

        image_class_list: [
            { title: 'img-responsive', value: 'img-responsive' },
        ],

        height: "480",

        setup: function(editor) {
            editor.on('init change', function() {
                editor.save();
            });
        },

        plugins: [
            "advlist autolink lists past image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste imagetools"
        ],

        toolbar: "insertfile undo redo | styleselect | bold italic | forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

        content_style: "body { margin: 1rem auto; min-height: 280px; padding:2px; padding-left:10px }",
    });*/


    ///////////////////////////////  end plugins  //////////////////////////
    ////////////////////////////////////////////////////////////////////////


    ////////////////////// start search categories //////////////////////////
    ////////////////////////////////////////////////////////////////////////

    $("#searchCategories").on("input", function() {

        var searchTxt = $(this).val();
        searchTxt = searchTxt.replace(/[.()+]/g, "\\$&");

        var patt = new RegExp(searchTxt, "i");

        $(".cover-categories label").each(function() {

            if (patt.test($(this).text())) {

                $(this).show(500);
            } else {

                $(this).hide(500);
            }
        })
    });

    ////////////////////// end search categories ///////////////////////////
    ////////////////////////////////////////////////////////////////////////


    /////////////////////// start reset date sale //////////////////////////
    ////////////////////////////////////////////////////////////////////////

    $('.reset_end_sale').on('click', function(e) {

        e.preventDefault();
        $(this).prev('input').val('');
    })

    ///////////////////////// end reset date sale //////////////////////////
    ////////////////////////////////////////////////////////////////////////


    ////////////////////////// start statements ////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    let indexStatement = $('.cover-statements').length - 1;

    $statement = $('.cover-statements:first').clone();

    $('.cover-statements.clone').remove();

    $('#create_statement').on('click', function(e) {

        e.preventDefault();

        $statement.find('input').each(function() {

            let oldName = $(this).attr('name');
            $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexStatement}]`))
        })

        $(this).before($statement.removeClass('d-none').clone())

        indexStatement++;
    })


    body.on('click', '.remove-statement', function() {

        indexStatement = 0

        $(this).parents('.cover-statements').fadeOut(500, _ => {

            $(this).parents('.cover-statements').remove();

            $('.cover-statements').each(function() {

                $(this).find('input').each(function() {

                    let oldName = $(this).attr('name');

                    $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexStatement}]`))
                })

                indexStatement++;
            });

        })


    })


    ////////////////////////// end statements //////////////////////////////
    ////////////////////////////////////////////////////////////////////////



    ////////////////////////// start kurly ////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    let indexKurly = $('.cover-kurly').length - 1;

    $kurly = $('.cover-kurly:first').clone();

    $('.cover-kurly.clone').remove();

    $('#create_kurly').on('click', function(e) {

        e.preventDefault();

        $kurly.find('input').each(function() {

            let oldName = $(this).attr('name');
            $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexKurly}]`))
        })

        $(this).before($kurly.removeClass('d-none').clone())

        indexKurly++;
    })


    body.on('click', '.remove-kurly', function() {

        indexKurly = 0

        $(this).parents('.cover-kurly').fadeOut(500, _ => {

            $(this).parents('.cover-kurly').remove();

            $('.cover-kurly').each(function() {

                $(this).find('input').each(function() {

                    let oldName = $(this).attr('name');

                    $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexKurly}]`))
                })

                indexKurly++;
            });

        })


    })


    ////////////////////////// end kurly //////////////////////////////
    ////////////////////////////////////////////////////////////////////////


    ////////////////////////// start color ////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    let indexColor = $('.cover-color').length - 1;

    $color = $('.cover-color:first').clone();

    $('.cover-color.clone').remove();

    $('#create_color').on('click', function(e) {

        e.preventDefault();

        $color.find('input').each(function() {

            let oldName = $(this).attr('name');
            $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexColor}]`))

        })
        console.log($color);
        $(this).before($color.removeClass('d-none').clone())
        var color_test = indexColor
        indexColor++;
        if (indexColor > 0) {
            $color.addClass('color-' + indexColor).removeClass('color-' + color_test);
            var input_color = $('.color-' + color_test + ' .color_id')
            input_color.attr('name', 'color[' + color_test + '][option][0][id]');
        }
    })


    body.on('click', '.remove-color', function() {

        indexColor = 0

        $(this).parents('.cover-color').fadeOut(500, _ => {

            $(this).parents('.cover-color').remove();

            $('.cover-color').each(function() {

                $(this).find('input').each(function() {

                    let oldName = $(this).attr('name');

                    $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexColor}]`))
                })

                indexColor++;
            });

        })


    })


    ////////////////////////// end color //////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    ////////////////////////// start size ////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    let indexSize = $('.cover-size').length - 1;

    $size = $('.cover-size:first').clone();

    $('.cover-size.clone').remove();

    $('#create_size').on('click', function(e) {

        e.preventDefault();

        $size.find('input').each(function() {

            let oldName = $(this).attr('name');
            $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexSize}]`))

        })
        console.log($size);
        $(this).before($size.removeClass('d-none').clone())
        var size_test = indexSize
        indexSize++;
        if (indexSize > 0) {
            $size.addClass('size-' + indexSize).removeClass('size-' + size_test);
            var input_size = $('.size-' + size_test + ' .size_id')
            input_size.attr('name', 'size[' + size_test + '][option][0][id]');
        }
    })


    body.on('click', '.remove-size', function() {

        indexSize = 0

        $(this).parents('.cover-size').fadeOut(500, _ => {

            $(this).parents('.cover-size').remove();

            $('.cover-size').each(function() {

                $(this).find('input').each(function() {

                    let oldName = $(this).attr('name');

                    $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexSize}]`))
                })

                indexSize++;
            });

        })


    })


    ////////////////////////// end size //////////////////////////////
    ////////////////////////////////////////////////////////////////////////
 
  ////////////////////////// start clothes check ////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    $('.is_clothes').on('change', function(e) {
            e.preventDefault();
            $('#size1').toggleClass('d-none')
        })
        ////////////////////////// end clothes check //////////////////////////////
        ////////////////////////////////////////////////////////////////////////




    ////////////////////////// start attributes ////////////////////////////
    ////////////////////////////////////////////////////////////////////////



    let indexAttribute = $('.cover-attributes').length - 1; //count attributes

    $attribute = $('.cover-attributes:first').clone(); //clone attributes

    $('.cover-attributes.clone').remove(); //remove clone

    $option = $('.cover-options:first').clone(); //cover-options

    $('.cover-options.clone').remove(); //remove clone

    $('#add_attribute').on('click', function(e) {

        e.preventDefault();

        let $attributeSelected = $('#chang_attribute option:selected');

        $attribute.find('.attr-title').text($attributeSelected.text()) // replace title collapse  attributes ar

        // replace info attribute chang
        attribute_id = $attribute.find('.attribute_id');
        oldName = attribute_id.attr('name');
        attribute_id.attr('name', oldName.replace(/\[[0-9]\]/, `[${indexAttribute}]`)).val($attributeSelected.val()); // replace index attributes and replace value bay the data entered

        if ($attributeSelected.attr('data-options')) {
            let data = $.parseJSON($attributeSelected.attr('data-options')),
                attribute_options = [];

            $.each(data, function($key, $val) {

                attribute_options.push(`<option data-id="${$val['id']}"  data-name_ar="${$val['name_ar']}" data-name_en="${$val['name_en']}" value="${$val['id']}">${$val['name_ar'] + ' | ' + $val['name_en']}</option>`)
            })
            $attribute.find('.chang_option').html(attribute_options)
            $(this).parent().append($attribute.removeClass('d-none').clone())

            indexAttribute++;

            $attributeSelected.addClass('d-none')

            $refreshOptions = $('#chang_attribute option:not(.d-none)');

            $('#chang_attribute').val($refreshOptions.val());

            $('.cover-attributes:not(:last-of-type)').find('.card.card-body').addClass('attributes-close').animate({
                'max-height': 110
            }, 500)

        }
    })

    $refreshOptions = $('#chang_attribute option:not(.d-none)');

    $('#chang_attribute').val($refreshOptions.val());

    body.on('click', '#add_option', function() {

        let indexAttribute = $(this).parents('.cover-attributes').find('.attribute_id').attr('name').replace(/[a-z\[\]]/ig, '');
        let optionSelected = $(this).siblings('.chang_option').find('option:selected');

        let parentThis = $(this);

        let indexOption = $(this).parents('.cover-attributes').find('.cover-options').length; //get count option now

        $option.find('input , select').each(function() {


            if ($(this).hasClass('inp-show')) {

                $(this).val(optionSelected.attr(`data-${$(this).attr('data-show')}`)); // replace  value

            } else if ($(this).hasClass('inp-select')) { // append option

                $attributeActiveVal = parentThis.parents('.cover-attributes').find('.attribute_id').val();

                let selectThis = $(this),
                    attribute_options = [];

                $('#chang_attribute option').each(function() {

                    let attributeName = $(this).text();

                    if ($(this).val() !== $attributeActiveVal) {

                        let data = $.parseJSON($(this).attr('data-options'));

                        $.each(data, function($key, $val) {

                            attribute_options.push(`<option data-id="${$val['id']}"  data-name_ar="${$val['name_ar']}" data-name_en="${$val['name_en']}" value="${$val['id']}">[${attributeName}] => ${$val['name_ar']+' | ' + $val['name_en']}</option>`)
                        })

                        selectThis.html("<option selected value='0'>lang_not_follow_option</option>" + attribute_options)

                    }
                })


                let oldName = $(this).attr('name').replace(/attributes\[[0-9]\]/, `attributes[${indexAttribute}]`); // old text data name

                $(this).attr('name', oldName) // replace index attribute

                $(this).attr('name', oldName.replace(/option]\[[0-9]\]/, `option][${indexOption}]`)) // replace index option

            } else {

                if ($(this).hasClass('option_id')) {

                    $(this).val(optionSelected.attr(`data-${$(this).attr('data-show')}`)); // replace  value

                }

                let oldName = $(this).attr('name').replace(/attributes\[[0-9]\]/, `attributes[${indexAttribute}]`); // old text data name

                $(this).attr('name', oldName) // replace index attribute

                $(this).attr('name', oldName.replace(/option]\[[0-9]\]/, `option][${indexOption}]`)) // replace index option


            }

        });


        $(this).parents('.card-body.option').append($option.clone())

        indexOption++;

    })


    let messageCreateOption = $('.message-create-option'),
        selectActive;

    body.on('click', '.open-modal-option', function(e) {

        e.preventDefault();


        $('.modal-content #inp_attribute_id').val($(this).parents('.cover-attributes').find('.attribute_id').val())

        selectActive = $(this).siblings('.chang_option');

        messageCreateOption.addClass('d-none')
    })



    body.on('click', '.new_option', function() {



        var form = $(this).parents('.modal-content').find('form');

        var data = new FormData(form[0]);

        $.ajax({

            url: form.attr('action'),
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,


            success: function(data) {

                messageCreateOption.removeClass('d-none')


                selectActive.append(`<option data-id="${data['id']}"  data-name_ar="${data['name_ar']}" data-name_en="${data['name_en']}" value="${data['id']}">${data['name_ar']+' | ' + data['name_en']}</option>`)

            },
            error: function(xhr) {

                $.each(xhr.responseJSON.errors, function(key, error) {

                    $('#myDataTable-' + key).html(error)
                })
            },

            beforeSend: _ => {

                $(this).addClass('d-none')

            },
            complete: _ => {

                $(this).removeClass('d-none')

            }
        })
    });



    body.on('click', '.remove-attribute', function(e) {

        e.preventDefault();

        if (window.confirm(lang_remove_attribute)) {

            indexAttribute = 0

            attributeid = $(this).parent().siblings('.attribute_id').val();

            $('#chang_attribute option').each(function() {


                if ($(this).val() === attributeid) {

                    $(this).removeClass('d-none')

                    $refreshOptions = $('#chang_attribute option:not(.d-none)');

                    $('#chang_attribute').val($refreshOptions.val());
                }
            });

            $(this).parents('.cover-attributes').fadeOut(500, function() { // fade put and remove attributes

                $(this).remove();

                $('.cover-attributes').each(function() { // each attributes


                    $(this).find('.inp-select , .inp-option , .attribute_id').each(function() { // each and  replace index name input  this attributes

                        let oldName = $(this).attr('name');

                        $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexAttribute}]`));

                    });

                    indexAttribute++;
                });

            })

        }

    })




    body.on('click', '.edit-attributes', function(e) {


        let nameAttrAr = window.prompt(lang_name_option_ar) //  attributes name ar
        let nameAttrEn = window.prompt(lang_name_option_en); //  attributes name en

        if (nameAttrAr) { //  check is enter name ar

            $(this).parents('.cover-attributes').find('.attr-title .ar').text(nameAttrAr) // replace title collapse  attributes ar
            $(this).parents('.cover-attributes').find('.attribute_name_ar').val(nameAttrAr) // replace value ar
        }

        if (nameAttrEn) { //  check is enter name en

            $(this).parents('.cover-attributes').find('.attr-title .en').text(nameAttrEn) // replace title collapse  attributes en
            $(this).parents('.cover-attributes').find('.attribute_name_en').val(nameAttrEn) // replace value ar

        }

    });

    body.on('click', '.collapse-attribute', function(e) {

        if ($(this).parents('.cover-attributes').find('.card.card-body').hasClass('attributes-close')) {

            $(this).parents('.cover-attributes').find('.card.card-body').removeClass('attributes-close').animate({
                'max-height': 425
            }, 500)

        } else {

            $(this).parents('.cover-attributes').find('.card.card-body').addClass('attributes-close').animate({
                'max-height': 110
            }, 500)
        }

    });


    body.on('click', '.remove-option', function(e) {


        let parentAttribute = $(this).parents('.cover-attributes');
        let countOption = parentAttribute.find('.cover-options').length

        if (countOption > 1) { // check count options in attributes > 1

            indexOption = 0;

            $(this).parents('.cover-options').fadeOut(500, function() { // fade out and remove this option

                $(this).remove();


                parentAttribute.find('.cover-options').each(function() { //  each option in attributes

                    $(this).find('.inp-option , .inp-select').each(function() { // each and  replace index name input  option

                        let oldName = $(this).attr('name').replace(/option]\[[0-9]\]/, `option][${indexOption}]`);

                        $(this).attr('name', oldName)
                    })

                    indexOption++;
                })


            });


        } else {

            alert(lang_min_one_option)

        }


    })


    ////////////////////////// end attributes ////////////////////////////
    ////////////////////////////////////////////////////////////////////////



    ////////////////////////// start validation ////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    $('form').on('submit', function() {

        // if ($('.cover-categories input[type=checkbox]:checked').length < 1) {

        //     alert(lang_min_one_category)

        //     return false;

        // }

        if ($('#sale_price').val().length < 1 && $('input[name=in_sale]').prop('checked')) {

            alert(required_value_sale)

            return false;

        }

        if ($('.cover-attributes').length < 1 && $('input[name=has_options]').prop('checked')) {

            alert(required_one_option)

            return false;

        }


       var notOption = false;

        $('.cover-attributes').each(function() {

            $(this).find('.cover-options').length <= 0 ? notOption = true : '';
        })

        if (notOption) {

            alert(required_value_attr)
            notOption = false;
            return false;
        }

        if (parseInt($('#sale_price').val()) >= parseInt($('#regular_price').val())) {

            alert(sale_bigger_price)

            return false;

        }

        return true
    })




    /////////////////////////// end validation /////////////////////////////
    ////////////////////////////////////////////////////////////////////////

    $('.btn-delete-img').on('click', function() {

        $(this).parent().remove()
    })
})
