$(function () {


    let body = $('body');

    let indexAttribute = $('.cover-attributes').length - 1; //count attributes

    $attribute = $('.cover-attributes:first').clone(); //clone attributes

    $('.cover-attributes.clone').remove(); //remove clone

    $('#create_attribute').on('click', function (e) {

        e.preventDefault();

        let nameAttrAr = window.prompt('اسم الخاصية باللغة العربية (اقصي حد 50 حرف)') //  attributes name ar
        let nameAttrEn = nameAttrAr ? window.prompt('اسم الخاصية باللغة الانجليزية (اقصي حد 50 حرف)') : ''; //  attributes name en

        if (nameAttrAr && nameAttrEn){ //  check is enter name ar and name en

            $attribute.find('.attr-title .ar').text(nameAttrAr) // replace title collapse  attributes ar
            $attribute.find('.attr-title .en').text(nameAttrEn) // replace title collapse  attributes en

            $attribute.find('input').each(function () {

                let oldName = $(this).attr('name'); // old text data name

                if (!$(this).hasClass('inp-option')) {

                    let nameAttr = $(this).hasClass('attribute_name_ar') ? nameAttrAr : nameAttrEn; // get value to this input
                    $(this).attr('name' , oldName.replace(/\[[0-9]\]/ , `[${indexAttribute}]`)).val(nameAttr); // replace index attributes and replace value bay the data entered

                }else {

                    $(this).attr('name' , oldName.replace(/\[[0-9]\]/ , `[${indexAttribute}]`))// replace index attributes

                }

            })

            $(this).before($attribute.removeClass('d-none').clone())

            indexAttribute++;

            $('.cover-attributes:not(:last-of-type)').addClass('attributes-close').animate({
                'max-height': 100
            } , 500)
        }
    })

    body.on('click' , '.remove-attributes', function(e){

        e.preventDefault();

        if (window.confirm('هل انت متاكد من حذف الخاصية : سوف يتم حذف الخاصية بكل الخيارات  التي بداخلها')) {
            indexAttribute = 0

            $(this).parents('.cover-attributes').fadeOut(500, function () { // fade put and remove attributes

                $(this).remove();

                $('.cover-attributes').each(function () { // each attributes


                    $(this).find('input').each(function () { // each and  replace index name input  this attributes

                        let oldName = $(this).attr('name');

                        $(this).attr('name', oldName.replace(/\[[0-9]\]/, `[${indexAttribute}]`));

                    });

                    indexAttribute++;
                });

            })

        }

    })




    body.on('click', '.edit-attributes' , function (e) {


        let nameAttrAr = window.prompt('اسم الخاصية باللغة العربية (اقصي حد 50 حرف)') //  attributes name ar
        let nameAttrEn = window.prompt('اسم الخاصية باللغة الانجليزية (اقصي حد 50 حرف)') ; //  attributes name en

        if (nameAttrAr) { //  check is enter name ar

            $(this).parents('.cover-attributes').find('.attr-title .ar').text(nameAttrAr) // replace title collapse  attributes ar
            $(this).parents('.cover-attributes').find('.attribute_name_ar').val(nameAttrAr) // replace value ar
        }

        if (nameAttrEn) { //  check is enter name en

            $(this).parents('.cover-attributes').find('.attr-title .en').text(nameAttrEn) // replace title collapse  attributes en
            $(this).parents('.cover-attributes').find('.attribute_name_en').val(nameAttrEn) // replace value ar

        }

    });

    body.on('click', '.collapse-attributes' , function (e) {

        if ($(this).parents('.cover-attributes').hasClass('attributes-close')){

            $(this).parents('.cover-attributes').removeClass('attributes-close').animate({
                'max-height': 425
            } , 500)

        }else {

            $(this).parents('.cover-attributes').addClass('attributes-close').animate({
                'max-height': 100
            } , 500)
        }

    });

    body.on('click', '#create_option' , function (e) {


        let indexOption = $(this).parent().find('.option').length; //get count option now
        let $option = $(this).prev('.option').clone(); // clone option

        $option.find('input').each(function () { // replace index option

            let oldName = $(this).attr('name');
            $(this).attr('name' , oldName.replace(/option]\[[0-9]\]/ , `option][${indexOption}]`)).val('')
        })

        $(this).before($option) // append option in attributes

        indexOption++;

    })

    body.on('click', '.remove-option' , function (e) {


        let parentAttribute = $(this).parents('.cover-attributes');
        let countOption = parentAttribute.find('.cover-options').length

        if (countOption > 1){ // check count options in attributes > 1

            indexOption = 0;

            $(this).parents('.option').fadeOut(500 , function () { // fade out and remove this option

                $(this).remove();


                parentAttribute.find('.cover-options').each(function () { //  each option in attributes

                    $(this).find('input').each(function (){ // each and  replace index name input  option

                        let oldName = $(this).attr('name');

                        $(this).attr('name' , oldName.replace(/option]\[[0-9]\]/ , `option][${indexOption}]`))
                    })

                    indexOption++;
                })


            });


        }else {

            alert('يجب ان يكون داخل كل خاصية خيار واحد علي الاقل او يمكنك حذف الخاصية كاملة')

        }


    })

    body.on('keyup', 'input.parent_id' , function (e) {

        $(this).parents('.cover-attributes').prevAll('.cover-attributes').find('.inp-option:not(.parent_id)').each(function () {

            inpName[$(this).attr('name')] =  $(this).val();

        })
    })



})
