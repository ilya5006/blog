let searchButton = document.querySelector('#searchButton');
let searchTextInput = document.querySelector('#searchText');
const allPosts = document.querySelectorAll('.post');

searchButton.addEventListener('click', (event) =>
{
    let posts = document.querySelector('#posts');
    posts.innerHTML = "";

    let suitablePosts = [];

    event.preventDefault();

    allPosts.forEach((post) =>
    {
        // Сначала ищем совпадения в загаловке поста
        let postTitle = post.querySelector('input[name=postNameButton]').value;
        let searchText = searchTextInput.value;

        let searchTextRegExp = new RegExp(searchText , 'i');

        let isPostTitleWithSameSearchText = postTitle.match(searchTextRegExp);
        
        if (isPostTitleWithSameSearchText)
        {
            suitablePosts.push(post);
        } // Если совпадений в загаловке не найдено, ищем их в тегах
        else
        {
            let postTags = post.querySelector('.postTags').textContent;
            let isPostTagsWithSameSearchText = postTags.match(searchTextRegExp);

            if (isPostTagsWithSameSearchText)
            {
                suitablePosts.push(post);
            }
        }
    });

    suitablePosts.forEach((post) =>
    {
        posts.insertAdjacentElement('beforeEnd', post);
    });
});