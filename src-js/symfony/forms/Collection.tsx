const htmlToNode = (html: string): Node => {
    var template = document.createElement('template');
    html = html.trim();
    template.innerHTML = html;
    return template.content.firstChild;
}

const EnableCollection = (): void => {
    const elems = document.querySelectorAll('.js-symfony-collection');
    const $elems = [].slice.call(elems);
    const addButton = htmlToNode('<a href="#" class="js-symfony-collection-add btn btn-secondary"><i class="fas fa-plus"></i></a>');

    addButton.addEventListener('click', function(event: Event) {
        event.preventDefault();

        const clickedElem = event.target as HTMLElement;
        const collectionContainer = clickedElem.parentNode.querySelectorAll('div')[0] as HTMLElement; //@TODO this does not seem to be very stable
        const labels = clickedElem.parentNode.querySelectorAll('.col-form-label');
        const lastLabel = (labels.length > 0) ? parseInt(labels[labels.length - 1].innerHTML) + 1 : 0;
        const newWidget = collectionContainer.dataset.prototype
                                                        .replace(/__name__label__/g, lastLabel.toString())
                                                        .replace(/__name__/g, lastLabel.toString());

        collectionContainer.appendChild(htmlToNode(newWidget));
    });

    $elems.map((elem) => {
        elem.parentNode.insertBefore(addButton, elem.nextSibling);
    });
}

export { EnableCollection }