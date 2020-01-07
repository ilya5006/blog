let calculatePagesQuantity = (postsQuantity, postsPerPage) =>
{
    return Math.ceil(postsQuantity / postsPerPage);
}

let showPages = () =>
{

}

let showPosts = (pageNumber, postsPerPage, posts) =>
{
    let postsDiv = document.querySelector('#posts');
    postsDiv.innerHTML = '';

    for (let page = pageNumber * postsPerPage; page <= pageNumber * postsPerPage + postsPerPage && page < posts.length; page++)
    {
        postsDiv.insertAdjacentElement('beforeEnd', posts[page]); 
    }
}

let pagination = document.querySelector('#pagination');

pagination.addEventListener('click', (event) =>
{
    event.preventDefault();

    if (event.target.tagName.toLowerCase() == 'a')
    {
        switchPage(parseInt(event.target.textContent), 30, allPosts);
    }
});