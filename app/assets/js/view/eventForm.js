let input = document.querySelector('.recurrence-input')
let label = document.querySelector('.recurrence-input').parentElement.querySelector('label')
let selectElement = document.querySelector('.recurrence-type')

if (selectElement.value === '0'){
    input.parentElement.classList.add('d-none')
    input.required = ''
}else {
    input.required = "required"
}

selectElement.addEventListener('change', (event) => {
    if(event.target.value === '0'){
        input.parentElement.classList.add('d-none')
        label.classList.remove('required')
        input.required = ''
    }else {
        input.parentElement.classList.remove('d-none')
        label.classList.add('required')
        input.required = "required"
    }
});

