const addBtn = document.querySelector('#add_subscriber_btn')
let delBtns = document.querySelectorAll('.del_subscriber_btn')

const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

    const item = document.createElement('fieldset');

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );


    item.firstChild.classList.add('mb-3','d-flex', 'flex-row', 'justify-content-around', 'align-items-end')
    item
        .querySelectorAll('label')
        .forEach(label=> {
            label.classList.add('text-dark')
        })
    const delBtn = document.createElement('BUTTON');
    delBtn.innerText = 'x'
    delBtn.classList.add('btn', 'btn-danger', 'mb-0')

    delBtn.addEventListener('click', removeSubscriberFromCollection)

    item.lastChild.appendChild(delBtn)

    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;
};

const removeSubscriberFromCollection = (e) => {
    e.currentTarget.closest('fieldset').remove();
}

delBtns.forEach(delBtn => {
    delBtn.addEventListener("click", removeSubscriberFromCollection)
});
addBtn.addEventListener("click", addFormToCollection)

