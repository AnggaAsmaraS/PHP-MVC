



$(function() {
    getTiket();
    insertPayment();
    interval;
    events();
    flashInterval;

});
getDiskon();


let card = document.querySelector('.card');
let imgPassword1 = document.querySelector('.input-group .password1');
let imgPassword2 = document.querySelector('.input-group .password2');
let inputPassword = document.querySelector(".input-group .pass");
let inputPassword2 = document.querySelector(".input-group #inputPassword2");

function events() {
    
    imgPassword1.addEventListener("click", passwordText1);
    imgPassword2.addEventListener("click", passwordText2);
}




let passwordText1 = () => {
    console.log(inputPassword.type)

    if(inputPassword.type === 'password') {
        inputPassword.setAttribute('type', 'text')
        imgPassword1.src = "http://localhost/mvctiket/public/img/eye.svg";
    }else {
        inputPassword.setAttribute('type', 'password');
        imgPassword1.src = "http://localhost/mvctiket/public/img/eye-slash.svg";
    }
}

let passwordText2 = () => {
    if(inputPassword2.type === 'password') {
        inputPassword2.setAttribute('type', 'text')
        imgPassword2.src = "http://localhost/mvctiket/public/img/eye.svg";
    }else {
        inputPassword2.setAttribute('type', 'password');
        imgPassword2.src = "http://localhost/mvctiket/public/img/eye-slash.svg";
    }
}


function myFunction() {
    let hex = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e"];
    let a;
    function gr(a) {
      for(let i=0; i<6; i++){
        let x =Math.round(Math.random() * 13);
        let y= hex[x];
        a +=y;
      }
      return a;
    }
    let color1 =gr("#");
    let color2 = gr("#");
    var angel = "to left";
    let linear = 'linear-gradient(' + angel + "," + color1 + "," + color2 + ")";
    card.style.background=linear;
    }

    const interval = setInterval(myFunction, 100);


function setRupiah(nilai = 0) {


    let rupiah = "Rp, " + new Intl.NumberFormat().format(nilai);

    return rupiah;

}

function getDiskon() {
    $(".form-select").change(function() {
        
        let idTiket = $(this).find("option:selected").attr('data-id');
       
        $.ajax({
            type : "post",
            url : "http://localhost/mvctiket/public/user/getDiskon",
            data : {idTiket : idTiket},
            dataType : "json",
            success : function(data) {
                $("#harga-diskon").html(setRupiah(data))

                $('.qty').on("input", function() {
                    let value = $(this).val();
                    let total = parseInt(data) * value;
                   $('#harga-diskon').html(setRupiah(total));
                   return total;
                })
            }
        })
    })
}


function getTiket() {
let qty = 1;

    $(".form-select").change(function() {
        let idTiket = $(this).find("option:selected").attr('data-id');

        $.ajax({
            type : "post",
            url : "http://localhost/mvctiket/public/user/getAllTiket",
            data : {
                idTiket : idTiket

            },
            dataType : "json",
            success : function(data) {
            
                
                if(data.stok === "0") {
                    $("#harga-tiket").html("Rp, 0")
                    $("#stok-tiket").html("Maaf Tiket Habis");
                    $("#jenis-tiket").html("Jenis Tiket : 0 " )
             
                } else {
                    $("#harga-tiket").html(setRupiah(data.harga))
                    $("#stok-tiket").html("Tiket : " + data.stok)
                    $("#jenis-tiket").html("Jenis Tiket : " + data.jenis)


                    $('.qty').val(qty);

                    let total = parseInt(data.harga) * qty;
                     $('#total').html(setRupiah(total));
                      
                  
                  $('.qty').on("input", function() {
                      let value = $(this).val();
                      let total = parseInt(data.harga) * value;
                     $('#total').html(setRupiah(total));
                       
                     return total;
                  })
                }
            
            }
        })
    })
    
}


function insertPayment() {
    $('#kirim').on('click', function (e) {
        // e.preventDefault();

        let hargaTiket = $('#harga-tiket').text();
        let qty = $('.qty').val();
        let total = $('#total').text();
        let stokTiket = $('#stok-tiket').text();
        let hargaDiskon =  $('#harga-diskon').text();

        $.ajax({
            type : "post",
            url : "http://localhost/mvctiket/public/user/bayarTiket",
            data : {
                stokTiket : stokTiket,
                harga : hargaTiket,
                quantity : parseInt(qty),
                total : total,
                hargaDiskon : hargaDiskon
            },

        })
    })
}

//interval flash
let flash = document.querySelector('.container .flash');

const flashInterval = setInterval(() => {
    flash.remove();
}, 2000);

