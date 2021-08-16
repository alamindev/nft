import axios from 'axios';
import { trim } from 'lodash';
import Swal from 'sweetalert2';

// instagram add new link validation
let instaInput = document.querySelector('.instagram--post-input');
let instaButton = document.querySelector('.instagram--post-button');
function instagramPostValidation(instaInput, instaButton){
    instaButton.addEventListener('click', () => {
        let inputValue = instaInput.value;
        if(trim(inputValue) !== ''){
            let regex = /(https:\/\/www.instagram.com\/p\/)+([a-zA-Z]||[0-9])/gm;
           let testInputValue =  regex.test(inputValue);
           if(testInputValue !== true){
                Swal.fire({
                    icon: 'error',
                    title: 'Link should be Instagram Post URL!',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
                })
           }else{
                axios.post('/api/link/add', {link: inputValue}).then(function(res){
                    if(res.data.success === true) {
                        instaInput.value= '';
                        Swal.fire({
                            icon: 'success',
                            title: 'Link added success! need admin approval to show this link.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                              }
                        });

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: res.data.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                              }
                        });
                    }
                });
           }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Please enter link to continue!',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
              })
        }
    });
};

// instagramPostValidation(instaInput, instaButton);



//  * coding for dropdown handler


$('#dropdown--handler').on('click', function (evt) {
    evt.stopPropagation();
    let single = evt.currentTarget.getElementsByTagName("ul")[0];
    single.classList.toggle("hidden");
});

// coding for sidbar menu show
$('#show--menu-bar').on('click', function (evt) {
    evt.stopPropagation();
    $('#sidebar-menu').removeClass('-right-64');
    $('#sidebar-menu').addClass('right-0');
    $(this).hide();
    $('#show--menu-times').show();
});
$('#show--menu-times').on('click', function (evt) {
    evt.stopPropagation();
    $('#sidebar-menu').removeClass('right-0');
    $('#sidebar-menu').addClass('-right-64');
    $(this).hide();
    $('#show--menu-bar').show();
});
$('#sidebar-menu').on('click', function (evt) {
    evt.stopPropagation();
});

$('body,html').on('click', function (e) {
    var container = $("#menu--handler");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.addClass('hidden');
    }
    $('#sidebar-menu').removeClass('right-0');
    $('#sidebar-menu').addClass('-right-64');
    $('#show--menu-bar').show();
    $('#show--menu-times').hide();
});

/**
 *
 * Profile photo uploaded
 */
 $(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $('#search').on('keyup', function(){
        let value = $(this).val();
        var url = $(this).data('remote');
        $.ajax({
            url:url ,
            type: 'GET',
            dataType: 'json',
            data: {value}
        }).done(function (res) {
            let result = $('.result');
            result.empty();
            if(res.success === true){
                let li = '';
                res.data.forEach(function(val){
                    li += `<li class="py-2 px-3 border-b last:border-b-0 hover:bg-gray-100 transition-all duration-200">
                        <a href="${res.url}/project/${val.slug}" class="flex">
                            <img class="w-8 h-8 object-cover rounded" src="${val.photo}" alt="project-image"/>
                            <p class="pl-2">${val.name}</p>
                        </a>
                    </li>`;
                })
                $('<ul class="absolute left-0 top-0 bg-white shadow w-full"></ul>').html(li).appendTo(result)
            }else if(res.empty === true){
                result.empty();
            }else{
                $('<ul class="absolute left-0 top-0 bg-white shadow w-full"></ul>').html('<li class="px-2 py-2">Data not found!</li>').appendTo(result)
            }
        });
    });
});
