
// Brand Click Handle
const brandElements = document.querySelectorAll('.category-link')
const inputElement = document.querySelector('.search-input')
const searchBtnElement = document.querySelector('.search-btn')


for(const brandElement of brandElements) {
    brandElement.onclick = function brandClickHandler() {
        // console.log(brandElement.textContent)
        if(brandElement.textContent !== 'All Products') {
            inputElement.value = brandElement.textContent
        }

        searchBtnElement.click()
    }
}

