let searchButton = document.querySelector('#search_button');
let searchTextInput = document.querySelector('#search_text');

searchButton.addEventListener('click', (event) =>
{
    let posts = document.querySelector('#posts');
    posts.innerHTML = "";

    let suitablePosts = [];

    event.preventDefault();

    allPosts.forEach((post) =>
    {
        // Сначала ищем совпадения в загаловке поста
        let postTitle = post.querySelector('.post_name').textContent;
        let searchText = searchTextInput.value;

        let searchTextRegExp = new RegExp(searchText , 'i');

        let isPostTitleWithSameSearchText = postTitle.match(searchTextRegExp);
        
        if (isPostTitleWithSameSearchText)
        {
            suitablePosts.push(post);
        } // Если совпадений в загаловке не найдено, ищем их в тегах
        else
        {
            let postTags = post.querySelector('.post_tags').textContent;
            let isPostTagsWithSameSearchText = postTags.match(searchTextRegExp);

            if (isPostTagsWithSameSearchText)
            {
                suitablePosts.push(post);
            }
        }
    });

    currentPosts = suitablePosts;

    showPosts(1, 5, currentPosts);
    showPages(1, currentPosts);
});