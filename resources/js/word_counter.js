$('.txtWithWordCounter').keyup(function () {
    refreshRemainingWords($(this));
});

function refreshRemainingWords(input) {
    var inputLabel = input.parent().find('label');
    var labelContent = inputLabel.text();
    var contentWithoutSpaces = input.val().replace(/  +/g, ' ');
    var allowedWords = input.data('max_words');
    input.val(contentWithoutSpaces);

    console.log(contentWithoutSpaces);

    var remainingWords = 0;

    if (input.val().length === 0) {
        remainingWords = allowedWords;
    } else {
        var wordCount = input.val().replace(/ $/g, '').split(' ').length;
        remainingWords = allowedWords - wordCount;
    }

    if (remainingWords < 0) {
        remainingWords = 0;
        deleteExtraWords(input, contentWithoutSpaces, allowedWords);
    }

    labelContent = labelContent.replace(/\d+ palabras/, remainingWords + ' palabras');
    inputLabel.text(labelContent);
}

function deleteExtraWords(input, content, wordLimit) {
    var content = content.replace(/\b(\w+)$/, '');
    
    while (content.split(' ').length > wordLimit) {
        content = content.replace(/(\S+?)$/, '').replace(/ $/g, '');
    }

    input.val(content);
}