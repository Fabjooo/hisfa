/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./sweetalert.min');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '.blocksVUE',
    data: {
        message: 'lel',
        stock: {},
        cubic: {},
    },
    methods: {
        plusBlock(id) {
            //alert(id);
            $.get('/blocks/length/'+id+'/increase', function(data){

                $('.stock_'+id).html( data.stock );
                $('.cubic_'+id).html( data.cubic );
            });
        },
        minusBlock(id) {
            //alert(id);
            $.get('/blocks/length/'+id+'/decrease', function(data){
                
                $('.stock_'+id).html( data.stock );
                $('.cubic_'+id).html( data.cubic );
            });
        }
    }
});


$('#siloAdd_submit').attr('disabled', true);

$('.silo-add-contents, .silo-add-number, .silo-add-volume').bind('keyup', function() {
    if(allFilled()) $('#siloAdd_submit').removeAttr('disabled');
});

function allFilled() {
    var filled = true;
    $('body input').each(function() {
        if($(this).val() == '') filled = false;
    });
    return filled;
}


$('.silo-edit .btn-edit-silo').on('click', function(e){

    e.preventDefault();

    $(this).val('Silo opslagen...');
    $(this).prop('disabled', true);

    var $button = $(this);

    $.ajax({
           type: "POST",
           url: '/silos/'+ $('.edit-silo #id').val() +'/editjson',
           data: $(".edit-silo").serialize(), // serializes the form's elements.
           success: function(data)
           {
                $button.val('Silo aanpassen');
                $button.prop('disabled', false);
           },
           error: function(e)
           {
               // oei
           }
         });

});

$('.edit-silo__block-form #name').keyup(function(e) {
    // Do something
});

$('.edit-silo__block-form #number').keyup(function(e) {
    // Do something
    console.log('Number has changed');
});

$('.edit-silo__block-form #type').keyup(function(e) {
    // Keyup does not work
});

$('.edit-silo__block-form #volume').keyup(function(e) {
    // Do something
    var amount = parseInt(e.target.value);

    var silo__top = $('.silo__image__top');
    var silo__middle = $('.silo__image__middle');
    var silo__bottom = $('.silo__image__bottom');

    silo__top.removeClass();
    silo__middle.removeClass();
    silo__bottom.removeClass();

    $('.silo__percentage').html(amount + '%');
    if(amount >= 90) {
        silo__top.addClass('silo__image__top').addClass('full');
        silo__middle.addClass('silo__image__middle').addClass('full');
        silo__bottom.addClass('silo__image__bottom').addClass('full');
    } else if(amount >= 50) {
        silo__top.addClass('silo__image__top').addClass('default');
        silo__middle.addClass('silo__image__middle').addClass('medium');
        silo__bottom.addClass('silo__image__bottom').addClass('medium');
    } else {
        silo__top.addClass('silo__image__top').addClass('default');
        silo__middle.addClass('silo__image__middle').addClass('default');
        silo__bottom.addClass('silo__image__bottom').addClass('empty');
    }
});
