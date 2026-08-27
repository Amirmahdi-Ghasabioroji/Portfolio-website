document.addEventListener('DOMContentLoaded', () => {
    const monthFilter = document.getElementById('month-filter');
    const posts = document.querySelectorAll('.blog-post');
    const emptyMessage = document.querySelector('.no-posts');

    if (!monthFilter) {
        return;
    }

    const applyFilter = () => {
        const selectedMonth = monthFilter.value;
        let visibleCount = 0;

        posts.forEach((post) => {
            const matches = selectedMonth === 'all' || post.dataset.month === selectedMonth;
            post.hidden = !matches;
            if (matches) {
                visibleCount += 1;
            }
        });

        if (emptyMessage) {
            emptyMessage.hidden = visibleCount > 0;
        }
    };

    monthFilter.addEventListener('change', applyFilter);
    applyFilter();
});
