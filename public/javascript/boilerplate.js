/**
 * JavaScript implementation of C's printf / C# & Java's String.Format
 * Credit: fearphage, StackOverflow http://stackoverflow.com/a/4673436/1845905
 */

// First, checks if it isn't implemented yet.
if (!String.prototype.format) {
  String.prototype.format = function() {
    var args = arguments;
    return this.replace(/{(\d+)}/g, function(match, number) {
      return typeof args[number] != 'undefined'
        ? args[number]
        : match
      ;
    });
  };
}
