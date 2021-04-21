export const ContainerColor = (mainItemsArray) => {

    const data = mainItemsArray;

    for (let i = 0; i < data.length; ++i) {
        i % 2 === 1 ? data[i].classList.add('container-grey') : data[i].classList.add('container-white');
    }
}