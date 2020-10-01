<h4> <center>Stock Tracker Command Line Interface </center></h4>

The Stock Tracker CLI aims toward a fully functional interface that lets you check stock value and other useful pieces of information about the stocks. The stock data is sourced by the [iexcloud](https://iexcloud.io/) API. You can sign up for free to get your keys.

To use the Stock Tracker you have to provide valid API Keys for a Stock Data Provider in your _.env_. Use the _.env.example_ for reference. The provider could be easily replaced by another one. To do so check out the _HttpClientService_.

To build an executable, standalone Stock Tracker run: `php stock-tracker app:build stock-tracker`

Supported Commands:
-`cap {symbol}`          Display market cap of the stock with the given symbol
-`company {symbol}`      Display information about the company of the stock with the given symbol
-`historic {symbol}`     Display historical price data of the stock with the given symbol
-`intraday {symbol}`     Display the intraday data of the stock with the given symbol
-`price {symbol}`        Display the current value of the stock with the given symbol
-`status`                Display status of Stock API

Example:
Will output the current market cap of Apple
`stock-tracker cap AAPL`


The Stock Tracker CLI is built with [Laravel Zero](https://laravel-zero.com/) made by [nunomaduro](https://twitter.com/enunomaduro).
