require('./bootstrap');
window.$ = require('jquery');
window.Swal =require("sweetalert2");
window.dt = require('datatables.net');


let allProductCart = document.querySelectorAll('.product-card');
let allProductDetailModal = document.querySelectorAll('.productDetailModal');

let quantityMinus = document.querySelectorAll('.quantityMinus');
let quantityPlus = document.querySelectorAll('.quantityPlus');


let productModalQuantity = document.querySelectorAll('.productModalQuantity');
let productModalCost = document.querySelectorAll('.productModalCost');
let productModalTitle = document.getElementsByClassName('productModalTitle');
let voucherList = document.getElementById('voucherList');

let storeVoucher = [];

//show productDetailModal
for(let  i=0;i<allProductCart.length;i++){
    let el = allProductCart[i];
    el.addEventListener('click',showProductDetailModal);
}
//Add to Voucher
let addtoVoucherBtn = document.getElementsByClassName('addToVoucherBtn');
for(let i=0;i<addtoVoucherBtn.length;i++){
    let btn = addtoVoucherBtn[i];
    btn.addEventListener('click',addToVoucher);
}








function voucherListCount(){
    let voucherListCount = document.getElementById("voucherListCount");
    // console.log(voucherListCount);
    voucherListCount.innerText = storeVoucher.length;
}

function voucherTotal(){
    let voucherTotal = document.getElementById("voucherTotal");
    voucherTotal.innerText = storeVoucher.reduce((x,y)=>x+Number(y.cost),0).toFixed(2)
}


function voucherListCreate(productId,title,productImg,price,quantity,cost){
    let li = document.createElement("li");
    li.classList.add('voucher-list-item','list-group-item','d-flex','justify-content-between','align-items-center','px-0','pe-1','border-0');
    // li.setAttribute("data-index",index)
    li.innerHTML = `
        <i class="fas fa-times text-danger remove-list px-2 voucher-list-del hide-in-print" data-product-id="${productId}" style="cursor: pointer"></i>
        <img src="${productImg}" alt="" class="vourcher-product-img rounded-2 me-1 hide-in-print" width="40px" height="40px">
        <div class="w-50 hide-in-print">
           <div class="">
                <h6 class="my-0 text-truncate voucher-product-name show-in-print-small-text">${title}</h6>
                <div class="hide-in-print ">
                    <small class="text-black-50 unit-price voucher-product-price" >
                        ${price}
                    </small>
                    <span class="text-black-50">x</span>
                    <small  class="text-black-50 unit-price voucher-product-quantity">
                        ${quantity}
                    </small>
                </div>
            </div>
        </div>
        <div class="text-muted w-25 voucher-cost text-end hide-in-print">${cost}</div>

<!--Show in Print-->
        <div class="text-black-50 w-50 ps-2 show-in-print">
            ${title}
        </div>
        <div class="small text-center text-nowrap show-in-print" style="width: 30%">
            <p class="text-black-50 unit-price voucher-product-price mb-0" >
                ${price} x  ${quantity}
            </p>
        </div>
        <div class="text-black-50 voucher-cost text-end text-nowrap pe-2 show-in-print" style="width: 20%">${cost}</div>

<!--End Show in print-->


    `;
    return li;
}




function calcCost(quantityElement){
    currentPrice = Number(quantityElement.getAttribute("price"));
    for(let i=0; i < productModalCost.length;i++) {
        if (isNaN(quantityElement.value) || quantityElement.value <= 0) {
            productModalCost[i].innerText = currentPrice;
        } else {
            productModalCost[i].innerText = (quantityElement.valueAsNumber * currentPrice).toFixed(2);
        }

    }
}

//Modal quantity Increase
for(let i=0;i<quantityPlus.length;i++){
    quantityPlus[i].addEventListener('click',function (){
        if(isNaN(productModalQuantity[i].value) || productModalQuantity[i].value <= 0){
            productModalQuantity[i].valueAsNumber = 1;
        }else{
            productModalQuantity[i].valueAsNumber += 1;
        }
        calcCost(productModalQuantity[i]);
    })
}

//quantity Decrease
for(let i=0;i<quantityMinus.length;i++){
    quantityMinus[i].addEventListener('click',function (){
        if(productModalQuantity[i].value > 1 ) {
            productModalQuantity[i].valueAsNumber -= 1;
            calcCost(productModalQuantity[i]);
        }
    })
}

//quantity Changes
let quantityInput = document.getElementsByClassName('productModalQuantity');
for (let i=0;i < quantityInput.length;i++){
    let input = quantityInput[i];
    input.addEventListener('keyup',quantityChanged);
    input.addEventListener('keypress',function (e){
        if (e.key === 'Enter') {
            // e.preventDefault();
            // console.log('this is e')
            addToVoucher(e);

        }
    });
}
// //quantity Changes function
function quantityChanged(event){
    let input = event.target;
    calcCost(input);
  }

function showProductDetailModal(event){
    let el = event.target.parentElement;
    console.log(el);
    let currentId = el.getAttribute('product-id');
    if(x = storeVoucher.find(el => el.product_id == currentId)){
        let productDetailModal = document.getElementById(`productDetailModal`+currentId);
        let modal = new bootstrap.Modal(productDetailModal);
        modal.show();
        productDetailModal.getElementsByClassName('productModalQuantity')[0].value = x.quantity;
        productDetailModal.getElementsByClassName('productModalCost')[0].innerText = x.cost;
    }else{
        let productDetailModal = document.getElementById(`productDetailModal`+currentId);
        let modal = new bootstrap.Modal(productDetailModal);
        modal.show();
        productDetailModal.getElementsByClassName('productModalQuantity')[0].value = 1;
        let productModalQuantity = productDetailModal.getElementsByClassName('productModalQuantity')[0];
        let price = productModalQuantity.getAttribute('price');
        productDetailModal.getElementsByClassName('productModalCost')[0].innerText = price;
    }

}

function closeProductDetailModal(id){
    let productDetailModal = document.getElementById(`productDetailModal`+id);
    const myModal = new bootstrap.Modal(productDetailModal);
    myModal.hide();
}


function addToVoucher(event){
    let el = event.target.parentElement.parentElement.parentElement.parentElement;
    let modalForm = el.getElementsByClassName('modalForm')[0];
    let modalFormId = modalForm.getAttribute('data-id');
    // let productDetailModal = el.getElementsByClassName('productDetailModal');
    // console.log(productDetailModal);
    let productModalTitle = modalForm.getElementsByClassName('productModalTitle')[0].innerText;
    let productModalImg = modalForm.getElementsByClassName('productModalImg')[0].src;
    let productModalUnitPrice = modalForm.getElementsByClassName('productModalQuantity')[0].getAttribute('price');
    let productModalQuantity = modalForm.getElementsByClassName('productModalQuantity')[0].valueAsNumber;
    let productModalCost = modalForm.getElementsByClassName('productModalCost')[0].innerText;

    if(x = storeVoucher.find(el => el.product_id == modalForm.getAttribute('data-id'))){
        console.log('shi tal');
        if (Number.isNaN(productModalQuantity)|| productModalQuantity <= 0) {
            productModalQuantity = 1;
        }

        let index = storeVoucher.findIndex(el => el.product_id == modalForm.getAttribute("data-id") )
        // console.log("data-id=>"+modalForm.getAttribute("data-id")+"product_id"+x.product_id+"index=>"+index);
        // return;
        x.quantity = productModalQuantity;
        x.cost = x.quantity * x.price;
        storeVoucher[index] = x;
        voucherList.innerHTML = null;
        storeVoucher.forEach(el=>{
            voucherList.append(voucherListCreate(
                el.product_id,
                el.title,
                el.img,
                el.price,
                el.quantity,
                el.cost,
            ));
        })


    }else{
        let v={
            product_id:modalForm.getAttribute("data-id"),
            title:productModalTitle,
            img:productModalImg,
            price : productModalUnitPrice,
            quantity : productModalQuantity,
            cost:productModalCost,
        }
        storeVoucher.push(v);

        voucherList.append(voucherListCreate(
            modalFormId,
            productModalTitle,
            productModalImg,
            productModalUnitPrice,
            productModalQuantity,
            productModalCost,

        ));

    }

    closeProductDetailModal(modalFormId);
    voucherListCount();
    voucherTotal();
    localStorage.setItem('storeVoucher',JSON.stringify(storeVoucher))

}

// product remove from voucher list
voucherList.addEventListener('click',function (e){
    console.dir(e.target)
    if(e.target.classList.contains("voucher-list-del")){
        let productId = e.target.getAttribute("data-product-id");
        console.log(productId)
        storeVoucher = storeVoucher.filter(el => el.product_id != productId)
        localStorage.setItem('storeVoucher',JSON.stringify(storeVoucher))

        e.target.parentElement.remove()
        voucherListCount()
        voucherTotal()
    }
})


window.addEventListener('load',function (){
    let data = localStorage.getItem("storeVoucher") ? JSON.parse(localStorage.getItem("storeVoucher")) : []
    console.log(data)
    storeVoucher = data
    data.forEach(el=>{
        voucherList.append(voucherListCreate(
            el.product_id,
            el.title,
            el.img,
            el.price,
            el.quantity,
            el.cost,
        ));
    })
    voucherListCount()
    voucherTotal()
})


function print(c_name,c_invoice){
    document.getElementById("v_customer_name").innerText= c_name;
    document.getElementById("v_invoice_number").innerText = c_invoice;
    console.log(c_name,c_invoice)
    window.print();
}


//send data to backend with axios
let checkOutBtn = document.getElementsByClassName('checkout-btn')[0];
checkOutBtn.addEventListener('click',function (){
// console.log(storeVoucher.length);
    if(storeVoucher.length !== 0){
        let data = {
            customer_name : document.getElementById("cName").value,
            invoice_number : document.getElementById("cIN").value,
            voucher_list : storeVoucher
        }
        // console.log(data);


        axios.post('/income/store-voucher',data)
            .then(function (response){
                if(response.status === 200){
                    console.log('this is message',response.data);
                    print(response.data.customer_name,response.data.invoice_number);
                    storeVoucher = [];
                    localStorage.setItem('storeVoucher',JSON.stringify(storeVoucher))
                    voucherList.innerHTML = null
                    voucherListCount();
                    voucherTotal();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Your Order Successed'
                    })
                }
            }).catch(function(error){
            console.log(error);
        })

    }else{
        alert ('please select product')
        return;
    }


    // axios.post('fruit/'+id,{
    //      "_token":'{{csrf_token()}}',
    //     "_method" : 'delete',
    //   }).then(function (reponse) {
    //     console.log(response.data);
    //
    //    })


})








