$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


let columns = [],
    nameDB = '',
    link = [],
    src = [],
    columnsData = {},
    optionSelect = {},
    tdBtnAction = $('<td  data-type="tdAction" class="td-action notExport notPrint notEdit"><div class="actionSingle"></div><div class="actionSelected d-none"></div></td>');
    tdOneDB = '',
    langWebSite = $('html').attr('lang'),
    langBtn = [],
    newLink = [],
    myTableTbody = $('.myDataTable-table tbody'),
    _token = $('meta[name=csrf-token]').attr('content'),
    selectLines = $('.selectLines'),
    selectFilter = $('.customFilter'),
    filterCloumn = selectFilter.attr('data-column'),
    filterSign = selectFilter.attr('data-sign'),
    count =selectLines.val(),
    startDataInfo = $('.btn-myDataTable .orderBy'),
    orderColumn = startDataInfo.attr('data-orderColumn'),
    orderBy = startDataInfo.val(),
    searchColumn = "id",
    search = " ",
    page = 1,
    filter = '',
    method = "get",
    tag_audio =
        "<audio controls onautocomplete='false' preload='none'> " +
        "<source src='' type='audio/ogg'> " +
        "<source src='' type='audio/mpeg'> " +
        "<source src='' type='audio/wav'> " +
        "Your browser does not support the audio element. " +
        "</audio>",
    tag_video =
        "<video width='320' height='240' controls> " +
        "<source src='' type='video/mp4'> " +
        "<source src='' type='video/ogg'> " +
        "Your browser does not support the video tag. " +
        "</video>",
    tag_link = "<a href=''></a>",
    tag_image = "<img src='' class='img-fluid img-myDatatable'>";



    if (langWebSite === 'ar'){

        let langNotData = "لا توجد اي بيانات لعرضها",
            langUpdate = 'منذ ثواني';
        langBtn['edit'] = 'تعديل';
        langBtn['delete'] = 'حذف';
        langBtn['deleteSelected'] = 'حذف المحدد';
        langBtn['printSelected'] = 'طباعة المحدد';
        langBtn['restore'] = 'استرجاع';
        langBtn['show'] = 'عرض';
        langBtn['restoreSelected'] = 'استرجاع المحدد';

        // var langNotData = "Tidak ada data untuk ditampilkan",
        //     langUpdate = 'beberapa detik lalu';
        // langBtn['edit'] = 'Sunting';
        // langBtn['delete'] = 'Menghapus';
        // langBtn['deleteSelected'] = 'Hapus yang Dipilih';
        // langBtn['printSelected'] = 'Cetak Terpilih';
        // langBtn['restore'] = 'pemulihan';
        // langBtn['show'] = 'menunjukkan';
        // langBtn['restoreSelected'] = 'kembali dipilih';


    }else{


        var langNotData = "There is no data to display",
            langUpdate = 'seconds ago';
        langBtn['edit'] = 'Edit';
        langBtn['delete'] = 'Delete';
        langBtn['deleteSelected'] = 'Delete Selected';
        langBtn['printSelected'] = 'Print Selected';
        langBtn['restore'] = 'Restore';
        langBtn['show'] = 'Show';
        langBtn['restoreSelected'] = 'Restore Selected';

    }


// split url
let split ='';
function splitUrl(url){

    split = url.split(/(\{[a-zA-z:.]+\})/g);

    split.forEach(function (val , key) {

        if (/\{\w+\.\w+\}/.test(val)){split[key] = val.replace(/[{}]/g , '').split('.')
        }
    })

    return split
}

function myDataTableColumns($columns) {

    let tdOneVal = $columns['tdOne'];

    if (tdOneVal !== 'none'){

        columnsData['tdOne'] = [];
        columnsData['tdOne'][0] =$('<td data-type="tdOne" data-name="tdOne" class="td-one notPrint notExport notEdit"><i class="fas fa-print print-single-row"></i><input data-tip=" تحديد السطر" type="checkbox" name="tdSelect[]" value="" class="td-select"><input data-tip="تركيز علي السطر" type="checkbox" value="" class="td-foucase"></td>');
        columnsData['tdOne']['nameDB'] = 'tdOne'

        if (tdOneVal !== undefined){

            columnsData['tdOne'][1] = splitUrl(tdOneVal);
            columnsData['tdOne'][2] = $('<a><i class="fas fa-external-link-square-alt"></i></a>');

        }

    }


    $columns['name'].forEach(function (name) {

        nameArr = name.trim().split(':');
        nameDB = nameArr[1] ? nameArr[1] : name;
        nameEdit =  nameArr[0];
        $calss = '';

        if ($columns['class']) {
            $calss = $columns['class'][nameEdit] !== undefined ? $columns['class'][nameEdit] : '';
        }
        columnsData[nameEdit] = [$('<td class="td_'+nameDB+' '+$calss+'" data-name="'+nameEdit+'"></td>')];
        columnsData[nameEdit]['typeEdit'] = 'text'
        columnsData[nameEdit]['nameDB'] = nameDB
    });

    $.each($columns['select'] , function (column_name  , select) {

        let valSelect,
            selected;


        if (Array.isArray(select)){

            valSelect = select[0];
            selected = select[1];

        }else {

            select = typeof select === 'string' ? JSON.parse(select) : select;

            valSelect = select;
            selected = '%%';
        }



        optionSelect[column_name]=[valSelect , selected]
        columnsData[column_name]['typeEdit'] = 'select';

    });

    $.each($columns['selectM'] , function (column_name  , select) {

        let valSelect,
            selected;

        if ($.isArray(select)) {

            valSelect = select[0]
            selected = select[1]
        }
        else {

            select = typeof select === 'string' ? JSON.parse(select) : select;

            valSelect = select;
            selected = '%%';
        }

        optionSelect[column_name]=[valSelect , selected]
        columnsData[column_name]['typeEdit'] = 'select-multiple';

    });

    $.each($columns['date'] , function (column_name  , data) {

        columnsData[column_name]['type'] = 'date'
        columnsData[column_name]['format'] = data
        columnsData[column_name]['typeEdit'] = data

    });

    $.each($columns['input'] , function (column_name , type) {

        type = type.trim();
        if (type === 'number') {
            columnsData[column_name]['typeEdit'] = 'number'
        } else if (type === 'textarea') {
            columnsData[column_name]['typeEdit'] = 'textarea'
        } else if (type === 'checkbox'){
            columnsData[column_name]['typeEdit'] = 'checkbox'
        } else if (type === 'text'){
            columnsData[column_name]['typeEdit'] = 'text'
        }

    });


    $.each($columns['link'] , function (column_name  , link) {

        columnsData[column_name][0].append(tag_link);
        columnsData[column_name]['type'] = 'link'
        columnsData[column_name]['url'] =  splitUrl(link)
    });

    $.each($columns['file'] , function (column_name , file) {


        let type = file.split('=>')[0],
            url  = file.split('=>')[1];
        columnsData[column_name]['typeEdit']
        columnsData[column_name]['typeEdit'] = 'file'

        if (type === 'audio'){

            columnsData[column_name][0].attr('data-type' , 'audio').append(tag_audio)
            columnsData[column_name]['type'] = 'file:audio'
            columnsData[column_name]['url'] = splitUrl(url)

        }else if (type === 'video'){

            columnsData[column_name][0].attr('data-type' , 'video').append(tag_video)
            columnsData[column_name]['type'] = 'file:video'
            columnsData[column_name]['url'] = splitUrl(url)

        }else {

            columnsData[column_name][0].attr('data-type' , 'image').append(tag_image)
            columnsData[column_name]['type'] = 'file:image'
            columnsData[column_name]['url'] = splitUrl(file)

        }

    });

    $.each($columns['alias'] , function (column_name , text) {

        columnsData[column_name]['alias'] = text
    });

    if ($columns['btn']){

        columnsData['btn'] = {}
        columnsData['btn']['nameDB'] = 'btn'

        $.each($columns['btn'] ,function ($btnName , btnAttr) {

            let btnUrl = $.isArray(btnAttr)
                ? btnAttr[0]
                : btnAttr;

            columnsData['btn'][$btnName] = [splitUrl(btnUrl)];

            if ($btnName === 'edit') {

                columnsData['btn'][$btnName]['btnActionSingle'] = $('<a href="" class="btn btn-outline-success dataEdit" title=" ' + langBtn['edit'] + '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg><i class="fas fa-edit fa-1x"></i> </a>')

            }else if ($btnName === 'show'){

                columnsData['btn'][$btnName]['btnActionSingle']   = $('<a href="" class="btn btn-warning"> ' + langBtn['show'] + '<i class="fas fa-open fa-1x"></i> </a>')

            }else if ($btnName === 'delete') {

                columnsData['btn'][$btnName]['btnActionSingle']   = $( '<a href="" class="btn btn-outline-danger dataDelete" title="' + langBtn['delete'] + '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> </a>')
                columnsData['btn'][$btnName]['btnActionSelected'] = $('<a href="" class="btn btn-outline-danger dataSelectedDelete"> ' + langBtn['deleteSelected'] + '<i class="fas fa-trash-alt"></i> </a>')

            }else if ($btnName === 'restore') {

                columnsData['btn'][$btnName]['btnActionSingle']   = $('<a href="" class="btn btn-success dataRestore"> ' + langBtn['restore'] + '<i class="fal fa-trash-undo"></i> </a>')
                columnsData['btn'][$btnName]['btnActionSelected'] = $('<a href="" class="btn btn-success dataSelectedRestore"> ' + langBtn['restoreSelected'] + '<i class="fal fa-trash-undo"></i> </a>')

            }else if ($btnName === 'print') {

                columnsData['btn'][$btnName]['btnActionSelected'] = $('<a href="" class="btn  btn-myLight print-selected-row"> ' + langBtn['printSelected'] + '<i class="fal fa-print"></i> </a>')

            }else {

               //console.log(btnAttr)
                let textButton  = btnAttr[1].split("||"),
                    textSingle = textButton[0],
                    textSelected = textButton[1] ? textButton[1] :false,
                    iconSingle = '',
                    iconSelected = '';

                let customClass = '';
                if (btnAttr[2] !== undefined) {
                    customClass   = btnAttr[2];
                }
                if (btnAttr[3] !== undefined) {
                    let iconButton   = btnAttr[2].split("||"),
                        iconSingle   = iconButton[0],
                        iconSelected = iconButton[1] ? iconButton[1] : false;
                }


                columnsData['btn'][$btnName]['btnActionSingle'] = $('<a target="_blank" href="" class="btn  btn-info '+customClass+ ' '+$btnName+'"> ' + textSingle + ' ' + iconSingle+ '</a>')

                if (textSelected) {

                    columnsData['btn'][$btnName]['btnActionSelected'] = $('<a href="" class="btn  btn-info '+customClass+ ' ' + $btnName + '"> ' + textSelected + ' ' + iconSelected + '</a>')
                }
            }


        });

    }
}

/////////////////////////////////// request /////////////////////////////
function formatDate() {

    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}


function dataTableAjax() {

    $.ajax({
        method,
        dataType: "json",
        data: {
            _token,
            count,
            orderColumn,
            orderBy,
            page,
            searchColumn,
            search,
            filter,
            myDataTableAjax: true,
        },

        beforeSend: function () {

            $('.animation-body').addClass('d-block');
        },

        complete: function () {

            $('.animation-body').removeClass('d-block');
        },

        success: function (response) {

            let responseData = response.dataDB.data,
                newRow = [];
            if (responseData.length > 0) {

                responseData.forEach(function (row) {

                    let columns  = [];
                    $.each(columnsData , function (name , columnContent) {

                        let newLink= '',
                            columnRealVal = null;


                        let columnName = columnContent['nameDB'],
                        columnVal = columnName.split('.'),
                            columnType = columnContent['type'];

                        if (!$.isArray(row[columnVal[0]])) {
                        //console.log(row[columnVal[0]])

                            if (columnVal[1] !== undefined &&  row[columnVal[0]]) {

                                columnVal = row[columnVal[0]][columnVal[1]]

                            }else {

                                columnVal = row[columnVal[0]]

                            }

                        } else {

                            let columnValArray = [],
                                i = 0,
                                space;

                            row[columnVal[0]].forEach(function (val) {
                                space = i !== 0 ? " | " : ''
                                val[columnVal[1]] !== undefined
                                    ? columnValArray += space + val[columnVal[1]]
                                    : '';
                                i++
                            })

                            columnVal = columnValArray;

                        }

                        if (columnContent.alias !== undefined) {

                            columnRealVal = columnVal;

                            let alias = columnContent.alias;

                            typeof alias !== 'object' ? alias = $.parseJSON(alias) : '';

                            columnVal = alias[columnVal]  !== undefined
                                ? alias[columnVal]
                                : columnVal

                        }

                        //td one


                        if ( columnName === 'tdOne') {

                            let newTdOne = '';
                            columnContent[0].children('input.td-select').val(row['id']);

                            if (columnContent[1]) {

                                columnContent[1].forEach(function (val) {

                                    // is set route arguments
                                    if (/^{\w+}$/.test(val)) {

                                        newLink += row[val.replace(/[{}]/g, '')];

                                    } else if ($.isArray(val)) {

                                        newLink += row[val[0]][val[1]]

                                    } else {

                                        newLink += val
                                    }

                                });

                                columnContent[2].attr('href' , newLink)
                                newTdOne = columnContent[0].clone();
                                newTdOne.prepend(columnContent[2][0].outerHTML);
                                columns.push(newTdOne[0].outerHTML)

                            }else {

                                columns.push(columnContent[0][0].outerHTML)

                            }


                        }
                        else if(columnName=="imaget"){
                            console.log(columnVal);
                            columns.push('<td data-type="imaget" data-name="imaget" class="td-one notPrint notExport notEdit">'+columnVal+'</td>');
                        }
                        else if(columnName=="imaget2"){
                            console.log(columnVal);
                            columns.push('<td data-type="imaget2" data-name="imaget2" class="td-one notPrint notExport notEdit">'+columnVal+'</td>');
                        }
                        // is normal column
                        else if ((!columnType  || columnType === 'number' ||  columnType === 'text') &&  columnName !== 'btn'){

                            if ( /.?T.[0-9]?:[0-9]/.test(columnVal)){
                                columnVal = columnVal.replace(/T/ , ' / ').replace(/\.0+Z/ , '')
                            }
                            clone = columnContent[0].clone();
                            clone.text(columnVal)
                            columnRealVal != null ? clone.attr('data-realVal' , columnRealVal) : '';
                            columns.push(clone[0].outerHTML)
                        }

                        // is link
                        else if (columnType === 'link' ){

                            columnContent['url'].forEach(function (val) {

                                // is set route arguments
                                if (/^{\w+}$/.test(val)){

                                    newLink += row[val.replace(/[{}]/g , '')];

                                } else if ($.isArray(val)){

                                    newLink += row[val[0]][val[1]]

                                } else {


                                    newLink += val
                                }

                            })

                            clone = columnContent[0].clone();
                            clone.children('a').attr('href' , newLink)
                                .text(columnVal)
                            columnRealVal != null ? clone.attr('data-realVal' , columnRealVal) : '';
                            columns.push(clone[0].outerHTML)
                        }

                        // is file
                        else if (/file:\w+/.test(columnType) ){

                            columnContent['url'].forEach(function (val) {

                                // is set route arguments
                                if (/^{\w.+}$/.test(val)){

                                    newLink += row[val.replace(/{/ , '').replace(/}/ , '')];

                                } else if ($.isArray(val)){

                                    newLink += row[val[0]][val[1]]

                                } else {

                                    newLink += val
                                }
                            })

                            columnType = columnType.split(':')[1]


                            if (columnType === 'image' ){

                                clone = columnContent[0].clone();
                                clone.children('img').attr('src' , newLink)
                                columns.push(clone[0].outerHTML)
                            }
                            else if (columnType === 'audio' ){

                                clone = columnContent[0].clone();
                                clone.children('audio').find('source').attr('src' , newLink)
                                columns.push(clone[0].outerHTML)
                            }
                            else if (columnType === 'video' ){

                                clone = columnContent[0].clone();
                                clone.children('video').find('source').attr('src' , newLink)
                                columns.push(clone[0].outerHTML)
                            }

                        }
                        // is date
                        else if (columnType === "date"){

                            if ( /.?T/.test(columnVal)){
                                columnVal = columnVal.replace(/T/ , ' / ').replace(/\.0+Z/ , ' ')
                            }

                            let newFormatDate = '',
                                columnFormat = columnContent['format'];

                            if (columnFormat !== 'date' &&  columnFormat !== 'time'){

                                newFormatDate  = columnVal

                            } else if (columnFormat === 'time'){

                                var date = new Date();

                                    columnVal  ? columnVal :  columnVal = date.getHours()+':'+date.getSeconds()

                                    newFormatDate = columnVal.split(' ')[1] ? columnVal.split(' ')[1] : columnVal.split(' ')[0]

                            } else if (columnFormat === 'date'){

                                if (columnVal){

                                    newFormatDate = columnVal.split(' ')[0]

                                }else {

                                    let date = new Date();

                                    newFormatDate = formatDate()
                                }


                            }

                            clone = columnContent[0].clone();
                            clone.text(newFormatDate)
                            columnRealVal != null ? clone.attr('data-realVal' , columnRealVal) : '';
                            columns.push(clone[0].outerHTML)

                        }

                        // is btn
                        else if (columnName === "btn"){

                            // columns.push(tdAction)

                            $.each(columnContent , function ($key , btn) {


                                if ($key !== 'nameDB') {

                                    btn[0].forEach(function (val) {

                                        // is set route arguments
                                        if (/^{\w+}$/.test(val)) {

                                            newLink += row[val.replace(/[{}]/g, '')];

                                        } else if ($.isArray(val)) {

                                            newLink += row[val[0]][val[1]]

                                        } else {


                                            newLink += val
                                        }

                                    })

                                    if (btn['btnActionSingle']) {

                                        tdBtnAction.children('div.actionSingle').append(btn['btnActionSingle'].attr('href', newLink))
                                    }
                                    if (btn['btnActionSelected']) {

                                        tdBtnAction.children('div.actionSelected').append(btn['btnActionSelected'].attr('href', newLink))
                                    }
                                }
                                newLink = ''
                            });

                            columns.push(tdBtnAction[0].outerHTML)

                            // console.log(...tdBtnAction)
                            // clone.children('a').attr('href' , newLink)
                            //     .text(columnVal)
                            // columns.push(clone[0].outerHTML)

                        }
                        console.log(columnName=="imaget");

                    }) // end loop in column table

                    newRow.push('<tr class="row-'+row.id+'">'+columns.toString()+'</tr>')

                });


                myTableTbody.html(newRow, $('.btnPaginate').html(response.btn))

            } else {

                myTableTbody.html("<tr><td colspan='12' class='h3 p-5 text-left'> ....... " + langNotData + "</td></tr>");

            }

        },


    });

}

setTimeout(function () {
    dataTableAjax();
} , 250);



$(function () {



    let
        body = $('body'),

        orderByShow = $('.orderByShow'),
        orderByAsc = $('.orderByAsc'),
        orderByAscLang = orderByAsc.attr('data-text'),
        href,
        modal = $('.modalAction .modal-body form'),
        message = $('.modalAction .message'),
        btnSelectAll = $('.selectAll-dataTable'),
        langSelect = btnSelectAll.attr('data-langSelect'),
        langDeselect = btnSelectAll.attr('data-langDeselect'),
        el,
        dataValInput,
        theadElement = [],
        counter = 0,
        aliasName = [];
       colLg = typeof colLg === 'undefined' ? 12 : colLg;

        elementModel = {
            'textarea' : $("<div class='form-group col-12'><label></label><textarea name='' class='form-control' rows='4'></textarea><span class='invalid-feedback' user='alert'><strong></strong></span></div>"),
            'select'   : $("<div class='form-group col-12 col-lg-"+colLg+"'><label></label><select name='' class='custom-select custom-select-md mb-3'></select></div>"),
            'selectM'  : $("<div class='form-group col-12 col-lg-"+colLg+"'><label></label><select multiple name='' class='custom-select custom-select-md mb-3'></select></div>"),
            'normal'   : $("<div class='form-group col-12 col-lg-"+colLg+"'><label></label><input  type='' name='' class='form-control' value=''>"),
            'error'    : $('<span class="invalid-feedback d-block" user="alert"><strong></strong></span></div></div>')
        }


    // save thead element text
    $('.myDataTable-table thead th').each(function () {
        theadElement[counter] = $(this).text();
        counter++;
    })


//////////////////////get data  After select paginate///////////////////////


    //count line
    selectLines.on('change', function () {
        count = $(this).val() // استخراج العدد
        dataTableAjax(); // تشغيل الفانكشن
    });

    //ORDER BY
    $('.orderBy').on('change', function () {

        orderColumn = 'id';
        orderBy = $(this).val(); //  التريب حسب القيمه
        dataTableAjax();


        if (orderBy === 'asc') { // تغير الايقونه لحقل ال id علشان لما اهتار من هنا هرتب علي ال id

            $('.theOrderColumn i:first').children('i').addClass('sort-by-asc').removeClass('sort-by-desc sort-by')

            $('.theOrderColumn .sort-by-desc').removeClass('sort-by-desc').addClass('sort-by-asc')

        } else {

            $('.theOrderColumn .sort-by-asc').removeClass('sort-by-asc').addClass('sort-by-desc')

        }
    });

    //Filter
    selectFilter.on('change', function () {
        if ($(this).val().length > 0) {

            filter = ['where', filterCloumn, filterSign, $(this).val()]
            orderColumn = 'id';
            dataTableAjax();

        }else {

            filter = '';
            orderColumn = 'id';
            dataTableAjax();
        }
    });

    /////////////////////////////////// paginate ////////////////////////
    body.on('click', '.page-link', function (e) {
        e.preventDefault();

        if (!$(this).prop('rel')) { // هتاكد ان الضغطه مش من زرار ال next  ولا ال prev

            page = $(this).text(); // هستخلص رقم الصفحه من الزرار
            dataTableAjax(); // هشغل الفانكشن


        } else if ($(this).prop('rel') === 'next' && !$(this).parent().is('disabled')) { //في حالة ان الزرر كان next
            page = $('.page-item.active').next().children().text(); //هحيب الزرار الاكتف بتاع الصفحه الي انا فيها واجيب قيمة الزرار الي بعدو  واحدث المتغير page
            dataTableAjax() // بعد كده هشغل الفانكشن وطبعا ال page  هيكون فيه رقم الصفحه الي بعد الي انا فيها يعني كده جبت ال next

        } else if ($(this).prop('rel') === 'prev' && !$(this).parent().is('disabled')) {
            page = $('.page-item.active').prev().children().text(); // هحيب الزرار الاكتف بتاع الصفحه الي انا فيها واجيب قيمة الزرار الي قبلو  واحدث المتغير page
            dataTableAjax() // // بعد كده هشغل الفانكشن وطبعا ال page  هيكون فيه رقم الصفحه الي قبل الي انا فيها يعني كده جبت ال prev

        }
    });

    //////////////////////////////// search //////////////////////

    body.on('click , change' ,'.input-search' , function (e){

        e.stopPropagation();
    })

    body.on('keyup' ,'.input-search input' , function (e){

        e.stopPropagation();
        searchColumn = $(this).attr('name'); // تغير الحقل الي هبحث بيه
        page = 1; // هرجع الصفحه لرقم واحد اول ما ابحث
        search = $(this).val(); // الكلمات الي هبحث عنها
        dataTableAjax();
    })

    body.on('change', '.myDataTable-select', function () {

        if (!$(this).children('option:selected').hasClass('.searchInTable')) {

            $('.myDataTable-search').removeClass('dataTable').addClass('dataDB')

        } else {

            $('.myDataTable-search').removeClass('dataDB').addClass('dataTable')
        }


    });


    $(".myDataTable-search.dataTable").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".myDataTable-table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    ////////////////////////////////// order by th ///////////////////
    body.on('click', '.theOrderColumn i', function () {


        let thisChildren = $(this);
        if (orderBy === 'asc') { //التحق انا كان تصاعدي
            orderColumn = $(this).parent('th').attr('data-orderColumn'); // تغير الحقل علي هرتب بناء علي قيمة حسب الحقل الي هدوس عليه
            orderBy = 'desc'; // لو كان تصاعدي فا هعكس القيمة علشان معني كده انو عايز التانزلي
            thisChildren.addClass('sort-by-desc').removeClass('sort-by sort-by-asc'); // هغير الايقونة للشكل التنازلي
            dataTableAjax(); // هنفذ الفانكشن واجيب الترتيب التانزلي
            $(this).parent('th').siblings().children('i').removeClass('sort-by-asc sort-by-desc').addClass('sort-by'); // همسح الايقونات التصاعديه او التازليه من الاشقاء


        } else { //عكس التصاعدي (تنازلي)
            orderColumn = $(this).parent('th').attr('data-orderColumn'); // تغير الحقل علي هرتب بناء علي قيمة حسب الحقل الي هدوس عليه
            orderBy = 'asc'; // لو كان تنازلي فا هعكس القيمة علشان معني كده انو عايز تصاعدي
            thisChildren.addClass('sort-by-asc').removeClass('sort-by sort-by-desc'); // هغير الايقونة للشكل التنازلي
            dataTableAjax(); //هنفذ الفانكشن واجيب الترتيب التصاعدي
            $(this).parent('th').siblings().children('i').removeClass('sort-by-asc sort-by-desc').addClass('sort-by'); // همسح الايقونات التصاعديه او التازليه من الاشقاء
            orderByShow.text(orderByAscLang); // هغير النص في الزرار بتاع الطلب باي
            orderByAsc.addClass('active').siblings().removeClass('active') // هضيف للسلكلت الي في الرار كلاس الاكتف


        }
    });

    ////////////////////////////////// reload ////////////////////////
    body.on('click', '.reload-dataTable', function () {
        dataTableAjax();

    });
    ////////////////////////////////// print /////////////////////////

    body.on('click', '.print-dataTable', function () {


        let dataThead = $('.myDataTable-table thead').html(),
            dataBody = $('.myDataTable-table tbody').html(),
            printTable = $('.myDataTable-print'),
            table = $(".myDataTable-print table");

        table.find('thead').removeClass('.thead-dark');
        table.html(dataThead + dataBody);
        printTable.show();
        print();
        printTable.hide();
        table.html('');

    });

    body.on('click' , '.td-foucase' , function (){

        $(this).parent().parent().toggleClass('trFoucase')
    })

    body.on('click', '.print-single-row', function () {


        let dataThead = $('.myDataTable-table thead').html(),
            dataRow = $(this).parents('tr').html(),
            printTable = $('.myDataTable-print'),
            table = $(".myDataTable-print table");

        table.html(dataThead + dataRow);
        printTable.show();
        print();
        printTable.hide();
        table.html('');

    });


    body.on('click', '.print-selected-row', function () {


        let allTr = [],
            dataThead = $('.myDataTable-table thead').html(),
            printTable = $('.myDataTable-print'),
            table = $(".myDataTable-print table");

        $('.td-select:checked').parents('tr').each(function () {
            allTr.push("<tr>" + $(this).html() + "</tr>")
        });

        table.html(dataThead + allTr);
        printTable.show();
        print();
        printTable.hide();
        table.html('');

    })


///////////////////////////////////////////////////////////


    /*
        - edit  : method post
        - delete  : method delete
        - restore  : method post
     */

    ////////////////////////// All function /////////////////////


    function animationMessage(alertName , text) {

        el = $('.animation-message-'+alertName);
        el.stop(false  , true);

        el.html(text);
        el.animate({right:5} ,850).delay(2000)
            .animate({right:'-100%'} , 600)

    }

    function sendToMethod(method , varThis){

        $.ajax({
            method,
            dataType: "json",
            url:$(varThis).attr('href'),

            beforeSend : function(){

                $('.animation-body').addClass('d-block');
            },

            complete : function(){

                $('.animation-body').removeClass('d-block');
            },

            success: (response) => {

                if (response.status === "success") {

                    $(varThis).parents('tr').remove();

                    if ($('.myDataTable-table tr').length < 2) {

                        $('.reload-dataTable').click()
                    }

                    animationMessage('success' , response.message);

                }else if (response.status === "error"){

                    animationMessage('error' , response.message);

                    // $(varThis).children('.lds-heart').removeClass('d-inline-block').addClass('d-none');
                }

            },

            error:function (xhr , status , error) {

                if (status.res === "error") {

                    $('.animation-body').removeClass('d-block').delay('300');

                    alert( error);

                    $.each(xhr.responseJSON.errors , function (key , error) {

                        message.html(`<div class=" alert alert-danger"> <span>${error} </span></div>`)
                    })

                }
            }
        })

    }


    function sendToMethodSelected(method , varThis){

        let tdSelected = [];

        $('.td-select:checked').each(function () {

            tdSelected.push($(this).val())
        });

        $.ajax({
            url:$(varThis).attr('href'),
            method:method,
            dataType: "json",
            data: { tdSelected },

            beforeSend : function(){

                $('.animation-body').addClass('d-block');
            },


            complete : function(){

                $('.animation-body').removeClass('d-block');
            },

            success: (response) => {

                if (response.status === "success") {

                    $('.td-select:checked').parents('tr').remove();

                    if ($('.myDataTable-table tr').length < 2) {

                        $('.reload-dataTable').click()
                    }

                    animationMessage('success' , response.message);

                    divActionSingle.addClass('d-block').removeClass('d-none');
                    divActionSelected.addClass('d-none').removeClass('d-block');
                    btnSelectAll.html(langSelect);

                }else if (response.status === "error"){

                    animationMessage( 'error' , response.message)
                }
            },

            error:function (xhr , status , error) {

                if (status === "error") {

                    alert( error);

                    $.each(xhr.responseJSON.errors , function (key , error) {
                        message.html(`<div class=" alert alert-danger"> <span>${error} </span></div>`)
                    })
                }
            }
        })

    }

    ////////////////////////// delete /////////////////////

    body.on('click' , '.dataDelete',function (e) {

        e.preventDefault();

        if (confirm('هل انت متاكد من ذالك سوف يتم حذف العنصر ')) {
            sendToMethod('delete', this)
        }
    });

    ////////////////////////// restore  /////////////////////


    body.on('click' , '.dataRestore',function (e) {

        e.preventDefault();
        if (confirm('هل تريد استرجاع العنصر من سلة المحذوفات ')) {

            sendToMethod('post', this)
        }
    });


    ///////////////////// select all /////////////////

    btnSelectAll.on('click'  , function () {

        let  tdSelectChecked = $('.td-select:checked');

        if (tdSelectChecked.length > 0) {

            tdSelectChecked.click()

        }else {

            $('.td-select').each(function () {
                $(this).click()
            })

        }


    });

    body.on( 'click' , '.btnPaginate .page-link'  , function() {
        btnSelectAll.html(langSelect);
    });



    body.on('click' , '.td-select' , function(){

        $(this).parent().parent().toggleClass('trSelect')

        divActionSelected = $('body .myDataTable-table .actionSelected');
        divActionSingle   = $('body .myDataTable-table .actionSingle');


        if ($('.td-select:checked').length > 0){

            btnSelectAll.html(langDeselect);
            divActionSelected.addClass('d-block').removeClass('d-none');
            divActionSingle.addClass('d-none').removeClass('d-block');

        }else {

            btnSelectAll.html(langSelect);
            divActionSingle.addClass('d-block').removeClass('d-none');
            divActionSelected.addClass('d-none').removeClass('d-block');

        }

    });



    ////////////////////// Restore selected All /////////////

    body.on('click' , '.dataSelectedRestore' ,  function (e) {


        e.preventDefault();

        if (confirm('هل تريد استرجاع العناصر المحدده  من سلة المحذوفات ')) {

            sendToMethodSelected('post', this);

        }
    });

    ////////////////////// delete selected All /////////////

    body.on('click' , '.dataSelectedDelete' ,  function (e) {

        e.preventDefault();

        if (confirm('هل انت متاكد من ذالك سوف يتم حذف العناصر المحددة  ')) {

            sendToMethodSelected('delete', this);
        }
    });



    ////////////////////////// edit  /////////////////////

    body.on('click' , '.dataEdit',function (e) {

        e.preventDefault();

        modal.html("");

        href = $(this).attr('href');

        let counter = 0;

        $(this).parents('td').siblings().each(function (){

            let tdName = $(this).attr('data-name'),
                isNotEdit = $(this).hasClass('notEdit'),
                uniqClass = 'myDataTable' + '-' + tdName,
                columnAttr = columnsData[tdName],
                columnDefaultText = theadElement[counter],
                alias = columnAttr.alias;
                dataValInput =   alias === undefined ? $(this).text().trim() : $(this).attr('data-realVal')
                valEdit = !$(this).hasClass('notVal') ? dataValInput : '';
                aliasName[columnAttr.nameDB] = columnAttr.alias;
            // ملخص السطرين الي فوق لو فية عندي الياسس نيم في الايدت هحط الاصل
            // ولو انا مديلو كلاسس نوت فال لو فيه الياسس نيم هيعرضو وفي التعديل مش هيعرضو

            if (!isNotEdit && tdName !== 'tdOne' && tdName !== 'btn') {

                type = columnAttr.typeEdit;

                if (type === "textarea") {

                    let textarea = elementModel.textarea.clone();

                    textarea.children('textarea')
                        .val(valEdit)
                        .attr('name' , tdName)
                        .addClass(uniqClass)
                        .prev('label').text(columnDefaultText);
                    modal.append(textarea);

                }

                else if (type === "select"){


                    let select = elementModel.select.clone(),
                        option = [];

                    if (optionSelect[tdName][1] ==='%%') {

                        // console.log(typeof  optionSelect[tdName][0])
                        // let data = typeof alias === 'object' ? alias = $.parseJSON(alias) : '';
                        $.each(optionSelect[tdName][0], function (key, val) {

                            if (alias){
                                selected = key == valEdit ? 'selected' : '';
                            }else {
                                selected = val === valEdit ? 'selected' : '';
                            }
                            option.push('<option value="' + key + '"' + selected + '>' + val + '</option>')
                        })

                    }
                    else {

                        let value = optionSelect[tdName][1];

                        $.each(optionSelect[tdName][0], function (key, val) {
                            selected = key === value ? 'selected' : '';
                            option.push('<option value="' + key + '"' + selected + '>' + val + '</option>')
                        })
                    }

                    select.children('select')
                        .html(option)
                        .attr('name' , tdName)
                        .addClass(uniqClass)
                        .prev('label').text(columnDefaultText);
                    modal.append(select);

                }

                else if (type === "select-multiple"){


                    let select = elementModel.selectM.clone(),
                        option = [];

                    if (optionSelect[tdName][1] ==='%%') {

                        let dataValInputTrim = []

                        valEdit.split('|').forEach(function ( val) {

                            dataValInputTrim.push(val.trim())
                        })


                        $.each(optionSelect[tdName][0], function (key, val) {

                            selected = dataValInputTrim.includes(key.toString()) ? 'selected' : '';
                            option.push('<option value="' + key + '"' + selected + '>' + val + '</option>')
                        })

                    }else {

                        let value = optionSelect[tdName][1];

                        $.each(optionSelect[tdName][0], function (key, val) {

                            selected =  value.includes(key) ? 'selected="selected"'  : '';
                            option.push('<option value="' + key + '"' + selected + '>' + val + '</option>')
                        })
                    }

                    select.children('select')
                        .html(option)
                        .attr('name' , tdName+'[]')
                        .attr('size' , 6)
                        .addClass(uniqClass)
                        .prev('label').text(columnDefaultText);
                    modal.append(select);

                }
                else  {

                    let input = elementModel.normal.clone(),
                        readonly  = tdName === 'id' ? 'readonly' :'';


                    input.children('input')
                        .val(valEdit)
                        .attr('name' , tdName)
                        .attr('type' , type)
                        .prop(readonly, true)
                        .addClass(uniqClass)
                        .prev('label').text(columnDefaultText);
                    modal.append(input);
                }
            }

            counter++;
        });

        $(this).parents('tr').addClass('active').siblings().removeClass('active');

        message.html("");
        $('.modalActionBtn').click();
    });


    //////////////////////////  update /////////////////////
    body.on('click','.modalAction .btnUpdate',function (e) {

        e.preventDefault();


        message.html("");

        let form = $('.modalAction').find('.modal-form')[0],
            formData = new FormData(form),
            trActive = $('.myDataTable-table tr.active td');

        formData.append('_method' , 'PUT');



        $.ajax({
            method: "post",
            url: href,
            dataType: 'json',
            contentType: false,
            processData: false,
            data:formData,

            beforeSend : function(){
                $('.animation-body').addClass('d-block');
                $('.modalAction .is-invalid').removeClass('is-invalid').next().remove()
            },
            complete : function(){

                $('.animation-body').removeClass('d-block');
            },
            success:function (response) {

                if (response.status === "success"){


                    trActive.each(function () {

                        let name = $(this).attr('data-name'),
                            url =  response.url ? response.url : [],
                            alias = response.alias === undefined ? aliasName[name] : alias,
                            newVal ='';

                        if (alias === undefined){

                            newVal = formData.get(name)

                        }else {

                            typeof alias !== 'object' ? alias = $.parseJSON(alias): '';

                            newVal =  alias[formData.get(name)]  !== undefined
                                ? alias[formData.get(name)]
                                : formData.get(name)

                            $(this).attr('data-realVal' , formData.get(name))
                        }
                        if (!$(this).hasClass('notEdit')) {

                            let typeData = columnsData[name].type;

                            if (typeData === 'link') {

                                if (url !== undefined) {

                                    $(this).html("<a href='"+url[name]+"'>" + newVal + " </a>");

                                }
                                else {

                                    $(this).text(newVal);

                                }

                            }
                            else if ((/file:\w/).test(typeData)){

                                let type  = typeData.split(':')[1]

                                if (type === 'image'){

                                    $(this).html("<img  src='"+url[name]+"' class='img-fluid img-myDatatable'>");

                                }

                                else if (type === 'video' || type === 'sound'){

                                    $(this).children().find('source').attr('src' , url[name])
                                }else{
                                    console.log(this);
                                }
                            }

                            else {

                                $(this).text(newVal);

                                if (columnsData[name].typeEdit === "select"){

                                    $(this).text(optionSelect[name][0][newVal])

                                }else if (columnsData[name].typeEdit === "select-multiple") {

                                    let allSelected = [],
                                        counter = 0,
                                        space;
                                    formData.getAll(name+'[]').forEach(function (val) {
                                        space = counter !== 0 ? " | " : ''

                                        allSelected += space + optionSelect[name][0][val]
                                        counter++
                                    })
                                    $(this).text(allSelected)
                                }
                            }

                        }
                        else if (name === 'tdOne' && url[name] !== undefined){

                            $(this).children('a').attr('href' , url['name'])
                        }
                    });

                    $('.myDataTable-table tr.active .td_updated_at').text(langUpdate)

                    message.html(`<div class=" alert alert-success"> <span>${response.message !== undefined ? response.message : 'updated success'} </span></div>`);

                }else if (response.status === "error"){

                    message.html(`<div class=" alert alert-danger"> <span>${response.message} </span></div>`)
                }

            },

            error:function (xhr) {
                // <span class="invalid-feedback d-block" user="alert"><strong></strong></span></div></div>

                $.each(xhr.responseJSON.errors , function (key , error) {

                    let htmlError = elementModel.error.clone();
                    htmlError.children('strong').text(error)
                    $('.modalAction .myDataTable-'+key).addClass('is-invalid').after(htmlError[0].outerHTML)
                })
            }
        })

    });

    $('#myDataTabel-model').on('hidden.bs.modal', function (e) {
        aliasName = [];
    })


});


///////////////////////////////////////////////


(function($){

    $.fn.extend({
        tableHTMLExport: function(options) {

            var defaults = {
                separator: ',',
                newline: '\r\n',
                ignoreColumns: '',
                ignoreRows: '',
                type:'csv',
                htmlContent: false,
                consoleLog: false,
                trimContent: true,
                quoteFields: true,
                filename: 'tableHTMLExport.csv',
                utf8BOM: true,
                orientation: 'p' //only when exported to *pdf* "portrait" or "landscape" (or shortcuts "p" or "l")
            };
            var options = $.extend(defaults, options);


            function quote(text) {
                return '"' + text.replace('"', '""') + '"';
            }


            function parseString(data){

                if(defaults.htmlContent){
                    content_data = data.html().trim();
                }else{
                    content_data = data.text().trim();
                }
                return content_data;
            }

            function download(filename, text) {
                var element = document.createElement('a');
                element.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(text));
                element.setAttribute('download', filename);

                element.style.display = 'none';
                document.body.appendChild(element);

                element.click();

                document.body.removeChild(element);
            }

            /**
             * Convierte la tabla enviada a json
             * @param el
             * @returns {{header: *, data: Array}}
             */
            function toJson(el){

                var jsonHeaderArray = [];
                $(el).find('thead').find('tr').not(options.ignoreRows).each(function() {
                    var tdData ="";
                    var jsonArrayTd = [];

                    $(this).find('th').not(options.ignoreColumns).each(function(index,data) {
                        if ($(this).css('display') != 'none'){
                            jsonArrayTd.push(parseString($(this)));
                        }
                    });
                    jsonHeaderArray.push(jsonArrayTd);

                });

                var jsonArray = [];
                $(el).find('tbody').find('tr').not(options.ignoreRows).each(function() {
                    var tdData ="";
                    var jsonArrayTd = [];

                    $(this).find('td').not(options.ignoreColumns).each(function(index,data) {
                        if ($(this).css('display') != 'none'){
                            jsonArrayTd.push(parseString($(this)));
                        }
                    });
                    jsonArray.push(jsonArrayTd);

                });


                return {header:jsonHeaderArray[0],data:jsonArray};
            }


            /**
             * Convierte la tabla enviada a csv o texto
             * @param table
             * @returns {string}
             */
            function toCsv(table){
                var output = "";

                if (options.utf8BOM === true) {
                    output += '\ufeff';
                }

                var rows = table.find('tr').not(options.ignoreRows);

                var numCols = rows.first().find("td,th").not(options.ignoreColumns).length;

                rows.each(function() {
                    $(this).find("td,th").not(options.ignoreColumns)
                        .each(function(i, col) {
                            var column = $(col);

                            // Strip whitespaces
                            var content = options.trimContent ? $.trim(column.text()) : column.text();

                            output += options.quoteFields ? quote(content) : content;
                            if(i !== numCols-1) {
                                output += options.separator;
                            } else {
                                output += options.newline;
                            }
                        });
                });

                return output;
            }


            var el = this;
            var dataMe;
            if(options.type == 'csv' || options.type == 'txt'){


                var table = this.filter('table'); // TODO use $.each

                if(table.length <= 0){
                    throw new Error('tableHTMLExport must be called on a <table> element')
                }

                if(table.length > 1){
                    throw new Error('converting multiple table elements at once is not supported yet')
                }

                dataMe = toCsv(table);

                if(defaults.consoleLog){
                   // console.log(dataMe);
                }

                download(options.filename,dataMe);


                //var base64data = "base64," + $.base64.encode(tdData);
                //window.open('data:application/'+defaults.type+';filename=exportData;' + base64data);
            }else if(options.type == 'json'){

                var jsonExportArray = toJson(el);

                if(defaults.consoleLog){
                    //console.log(JSON.stringify(jsonExportArray));
                }
                dataMe = JSON.stringify(jsonExportArray);

                download(options.filename,dataMe)
                /*
                var base64data = "base64," + $.base64.encode(JSON.stringify(jsonExportArray));
                window.open('data:application/json;filename=exportData;' + base64data);*/
            }
            return this;
        }
    });
})(jQuery);

$(function () {


    $('.csv-dataTable').on('click' , function () {

        let fileName = window.prompt('insert file name' , 'csv_table');

        fileName = fileName === '' ? 'csv_table.csv' : fileName+'.csv';

        $(".myDataTable-table").tableHTMLExport({

            type: 'csv',
            filename : fileName,
            // for csv
            separator: ',',
            newline: '\r\n',
            trimContent: true,
            quoteFields: true,
            ignoreColumns:'.notExport',
        });
    });

    $('.json-dataTable').on('click' , function () {

        $(".myDataTable-table").tableHTMLExport({

            type: 'json',
            filename: "json_table.json",
            ignoreColumns:'.notExport',


        });
    });



});
