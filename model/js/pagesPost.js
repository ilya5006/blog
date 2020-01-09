let calculatePagesQuantity = (postsQuantity, postsPerPage) =>
{
    return Math.ceil(postsQuantity / postsPerPage);

}

let showPages = (activePage, posts) =>
{
    let pagesQuantity = calculatePagesQuantity(posts.length, 5);

    pagination.innerHTML = '';

    if (pagesQuantity < 6)
    {
        for (let page = 1; page <= pagesQuantity; page++)
        {
            if (page == activePage)
            {
                pagination.insertAdjacentHTML('beforeEnd', `<a href="#" class="active_page">${page}</a>`);
            }
            else
            {
                pagination.insertAdjacentHTML('beforeEnd', `<a href="#">${page}</a>`);
            }
        }
    }
    else
    {
        let isDotsOnlyStart = activePage > pagesQuantity - 3;
        let isDotsOnlyEnd =  activePage < 4;

        if (isDotsOnlyStart)
        {
            pagination.insertAdjacentHTML('beforeEnd', `<a href="#">1</a>`);
            pagination.insertAdjacentHTML('beforeEnd', `<a href="#">...</a>`);
            for (let page = pagesQuantity - 3; page <= pagesQuantity; page++)
            {
                if (page == activePage)
                {
                    pagination.insertAdjacentHTML('beforeEnd', `<a href="#" class="active_page">${page}</a>`);
                }
                else
                {
                    pagination.insertAdjacentHTML('beforeEnd', `<a href="#">${page}</a>`);
                }
            }
        }
        else if (isDotsOnlyEnd)
        {
            for (let page = 1; page <= 4; page++)
            {
                if (page == activePage)
                {
                    pagination.insertAdjacentHTML('beforeEnd', `<a href="#" class="active_page">${page}</a>`);
                }
                else
                {
                    pagination.insertAdjacentHTML('beforeEnd', `<a href="#">${page}</a>`);
                }
            }
            pagination.insertAdjacentHTML('beforeEnd', `<a href="#">...</a>`);
            pagination.insertAdjacentHTML('beforeEnd', `<a href="#">${pagesQuantity}</a>`);
        }
        else
        {
            pagination.insertAdjacentHTML('beforeEnd', `<a href="#">1</a>`);
            pagination.insertAdjacentHTML('beforeEnd', `<a href="#">...</a>`);
            
            for (let page = activePage - 1; page <= activePage + 1; page++)
            {
                if (page == activePage)
                {
                    pagination.insertAdjacentHTML('beforeEnd', `<a href="#" class="active_page">${page}</a>`);
                }
                else
                {
                    pagination.insertAdjacentHTML('beforeEnd', `<a href="#">${page}</a>`);
                }
            }

            pagination.insertAdjacentHTML('beforeEnd', `<a href="#">...</a>`);
            pagination.insertAdjacentHTML('beforeEnd', `<a href="#">${pagesQuantity}</a>`);
        }
    }
}

let showPosts = (pageNumber, postsPerPage, posts) =>
{
    let postsDiv = document.querySelector('#posts');
    postsDiv.innerHTML = '';

    let firstPostToShow = (pageNumber - 1) * postsPerPage;

    for (let page = firstPostToShow; page < firstPostToShow + postsPerPage && page < posts.length; page++)
    {
        postsDiv.insertAdjacentElement('beforeEnd', posts[page]);
    }

    postsDiv.insertAdjacentElement('beforeEnd', pagination); // Ибо страницы затираются вместе с постами
}

let pagination = document.querySelector('#pagination');

showPages(1, currentPosts);
showPosts(1, 5, currentPosts);

pagination.addEventListener('click', (event) =>
{
    event.preventDefault();

    if (event.target.tagName.toLowerCase() == 'a') 
    {
        showPosts(parseInt(event.target.textContent), 5, currentPosts);

        document.querySelector('.active_page').classList.remove('active_page');
        event.target.classList.add('active_page');
    }
});