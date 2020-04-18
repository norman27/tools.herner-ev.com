const htmlToNode = (html: string): Node => {
    var template = document.createElement('template');
    html = html.trim();
    template.innerHTML = html;
    return template.content.firstChild;
}

const EnableCollection = (): void => {
    const forms = document.querySelectorAll('.js-symfony-collection');
    const formNodes = [].slice.call(forms);

    Array.prototype.forEach.call(formNodes, function(elem, index, array) {
        const addButton = htmlToNode('<button class="js-symfony-collection-add btn btn-secondary"><i class="fas fa-plus"></i></button>');
        addButton.addEventListener('click', function(event: any) { // @TODO figure out proper type
            event.preventDefault();

            const clickedElem = (event.target.nodeName === 'I') ? event.target.parentElement as HTMLElement : event.target as HTMLElement;
            const collectionContainer = clickedElem.parentNode.querySelectorAll('div')[0] as HTMLElement;
            const labels = clickedElem.parentNode.querySelectorAll('.col-form-label');
            const lastLabel = (labels.length > 0) ? parseInt(labels[labels.length - 1].innerHTML) + 1 : 0;
            const newWidget = collectionContainer.dataset.prototype
              .replace(/__name__label__/g, lastLabel.toString())
              .replace(/__name__/g, lastLabel.toString());

            collectionContainer.appendChild(htmlToNode(newWidget));
        });

        const oldButton = elem.parentNode.getElementsByClassName('js-symfony-collection-add');
        if (oldButton.length > 0) {
            oldButton.remove();
        }
        elem.parentNode.insertBefore(addButton, elem.nextSibling);
    });
}

export { EnableCollection }