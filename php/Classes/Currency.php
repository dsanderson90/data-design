<?php

/**
 ** @author David Sanderson <sanderdj90@gmail.com>
 *
 * Namespacing does for functions and classes what scope does for variables.
 *
 **/
namespace dsanderson3\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");


use Ramsey\Uuid\Uuid;


 class Currency implements \JsonSerializable {

	 use ValidateUuid;

	 /**
	  * Uuid for a specific currency; this is the primary key.
	  * @var Uuid $currencyId
	  **/

	 private $currencyId;
	 /**
	  * 24hr change of specific currency.
	  * @var float $currencyChange
	  **/
	 private $currencyChange;
	 /**
	  * Total circulating supply of specific currency.
	  **/
	 private $currencyCircSupply;
	 /**
	  * Market Capitalization of specific currency.
	  **/
	 private $currencyMarketCap;
	 /**
	  * Current price of specific currency.
	  **/
	 private $currencyPrice;
	 /**
	  * PriceGraph of specific currency.
	  **/
	 private $currencyPricegraph;
	 /**
	  * Volume of specific currency.
	  **/
	 private $currencyVolume;

	 /**
	  * constructor for this Currency
	  *
	  * @param string|Uuid $newCurrencyId id of this currency or null if a new Currency.
	  * @param  float| $newCurrencyChange % Change of the currency price in the past 24 hours.
	  * @param $newCurrencyCircSupply float | totalCirculatingSupply  of unique coin.
	  * @param $newCurrencyMarketCap float | totalMarketCapitalization of unique coin.
	  * @param $newCurrencyPrice float | currentCurrencyPrice of unique coin.
	  * @param $newCurrencyPriceGraph float | data of price movement over time. Data is plugged in a graphical floaterface in later implementations.
	  * @param $newCurrencyVolume float | total Volume of trades in the past 24 hours.
	  */

	 public function __construct($newCurrencyId, float $newCurrencyChange, float $newCurrencyCircSupply, float $newCurrencyMarketCap, float $newCurrencyPrice, float $newCurrencyPriceGraph, float $newCurrencyVolume) {

		 try {
			 $this->setCurrencyId($newCurrencyId);
			 $this->setCurrencyChange($newCurrencyChange);
			 $this->setCurrencyCircSupply($newCurrencyCircSupply);
			 $this->setCurrencyMarketCap($newCurrencyMarketCap);
			 $this->setCurrencyPrice($newCurrencyPrice);
			 $this->setCurrencyPriceGraph($newCurrencyPriceGraph);
			 $this->setCurrencyVolume($newCurrencyVolume);
		 } //determine what exception type was thrown
		 catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			 $exceptionType = get_class($exception);
			 throw(new $exceptionType($exception->getMessage(), 0, $exception));
		 }
	 }

	 /**
	  * accessor/getter method for currency id
	  *
	  * @return Uuid value for currency id
	  */
	 public function getCurrencyId(): Uuid {
		 return ($this->currencyId);

		 //this outside of class
		 //$currency->getCurrencyId();
	 }

	 /**
	  *
	  * mutator (setter) method for currency id
	  * @param Uuid|string $newCurrencyId new value of currency id
	  * @throws \RangeException if $newCurrencyId is not positive
	  * @throws \TypeError if not a float
	  */

	 public function setCurrencyId($newCurrencyId): void {
		 try {
			 $uuid = self::validateUuid($newCurrencyId);
		 } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		 }
		 //convert and store the currency id
		 $this->currencyId = $uuid;

	 }

	 /**
	  * getter/accessor method for currency change
	  *
	  * @return float value for currency change over past 24 hours
	  */
	 public function getCurrencyChange(): float {
		 return ($this->currencyChange);
	 }

	 /**
	  * mutator/setter for Currency Change
	  *
	  * @param float | $newCurrencyChange sets new value for Currency Change.
	  * @throws \RangeException if $newCurrencyChange is negative or out of range.
	  */
	 public function setCurrencyChange(float $newCurrencyChange): void {
		 if($newCurrencyChange < 0.0 || $newCurrencyChange > 10000000000.00) {
			 throw(new \RangeException("Currency Change is negative or out of range"));
		 }

		 //convert and store the currency change
		 $this->currencyChange = $newCurrencyChange;
	 }

	 /**
	  * accessor/getter method for currency change
	  * @return float value of currency change
	  *
	  */
	 public function getCurrencyCircSupply(): float {
		 return $this->currencyCircSupply;
	 }

	 /**
	  * mutator/setter for $currencyCircSupply
	  * @param float \ $currencyCircSupply sets new value for Currency Circulating Supply
	  * @throws \RangeException if $currencyCircSupply is negative or out of range.
	  */

	 public function setCurrencyCircSupply($currencyCircSupply): void {
		 if($currencyCircSupply < 0.0 || $currencyCircSupply > 100000000000000.00) {
			 throw(new \RangeException("Currency Circulating Supply is negative or out of range"));
		 }
		 $this->currencyCircSupply = $currencyCircSupply;
	 }


	 /**
	  *  accessor/getter for Currency Market Cap
	  * @return float for Currency Market Cap
	  */
	 public function getCurrencyMarketCap(): float {
		 return $this->currencyMarketCap;
	 }

	 /**
	  * mutator/setter for $currencyMarketCap
	  * @param float \ $currencyCircSupply sets new value for Currency Circulating Supply
	  * @throws \RangeException if $currencyCircSupply is negative or out of range.
	  */
	 public function setCurrencyMarketCap($currencyMarketCap): void {
		 if($currencyMarketCap < 0.0 || $currencyMarketCap > 100000000000000.00) {
			 throw(new \RangeException("Currency Market Capitalization is negative or out of range"));
		 }
		 $this->currencyMarketCap = $currencyMarketCap;
	 }

	 /**
	  *  accessor/getter for Currency Market Price
	  * @return float for Currency Market Price
	  **/

	 public function getCurrencyPrice(): float {
		 return $this->currencyPrice;
	 }

	 /**
	  * mutator/setter for Currency Price
	  * @param float \  sets new value for Currency Price
	  * @throws \RangeException if Currency Price is negative or out of range.
	  **/
	 public function setCurrencyPrice($currencyPrice): void {
		 if($currencyPrice < 0.0 || $currencyPrice > 100000000000000.00) {
			 throw(new \RangeException("Currency Price is negative or out of range"));
		 }
		 $this->currencyPrice = $currencyPrice;
	 }

	 /**
	  *  accessor/getter for Currency Price Graph
	  * @return float for Currency Price Graph
	  **/
	 public function getCurrencyPricegraph(): float {
		 return $this->currencyPricegraph;
	 }

	 /**
	  * mutator/setter for Currency Price Graph
	  * @param float \ $currencyCircSupply sets new value for Currency Price Graph
	  * @throws \RangeException if Currency Price Graph is negative or out of range.
	  **/
	 public function setCurrencyPriceGraph($currencyPriceGraph): void {
		 if($currencyPriceGraph < 0.0 || $currencyPriceGraph > 100000000000000.00) {
			 throw(new \RangeException("Currency Price Graph is negative or out of range"));
		 }
		 $this->currencyPricegraph = $currencyPriceGraph;
	 }

	 /**
	  *  accessor/getter for Currency Volume
	  * @return float for Currency Volume
	  **/
	 public function getCurrencyVolume(): float {
		 return $this->currencyVolume;
	 }

	 /**
	  * mutator/setter for Currency Volume
	  * @param float \ sets new value for Currency Volume
	  * @throws \RangeException if Currency Volume is negative or out of range.
	  **/
	 public function setCurrencyVolume($currencyVolume): void {
		 if($currencyVolume < 0.0 || $currencyVolume > 100000000000000.00) {
			 throw(new \RangeException("Currency Volume is negative or out of range"));
		 }
		 $this->currencyVolume = $currencyVolume;
	 }

/**
 * inserts this Currency into MySQL
 *
 * * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 *
 **/


public function insert(\PDO $pdo) : void {
	$query = "INSERT INTO currency(currencyId, currencyChange, currencyCircSupply,currencyMarketCap,currencyPrice,currencyPricegraph,currencyVolume) VALUES (:currencyId, :currencyChange, :currencyCircSupply, :currencyMarketCap, :currencyPrice, :currencyPricegraph, :currencyVolume)";
$statement = $pdo->prepare($query);

$parameters=["currencyId" => $this->currencyId->getBytes(), "currencyCircSupply" => $this ->currencyCircSupply, "currencyMarketCap"=> $this->currencyMarketCap, "currencyPrice"=> $this->currencyPrice, "currencyPriceGraph"=>$this->currencyPricegraph, "currencyVolume"=>$this->currencyVolume];
$statement->execute($parameters);

 }

	 /**
	  * deletes this Tweet from mySQL
	  *
	  * @param \PDO $pdo PDO connection object
	  * @throws \PDOException when mySQL related errors occur
	  * @throws \TypeError if $pdo is not a PDO connection object
	  **/

 public function delete(\PDO $pdo) : void {

 		// create query template
	 	$query = "DELETE FROM currency WHERE currencyId = :currencyId";
	 	$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
	 	$parameters = ["currencyId" => $this->currencyId->getBytes()];
	 	$statement->execute($parameters);
 }
	 /**
	  * updates this Currency in mySQL
	  *
	  * @param \PDO $pdo PDO connection object
	  * @throws \PDOException when mySQL related errors occur
	  * @throws \TypeError if $pdo is not a PDO connection object
	  **/

	 public function update(\PDO $pdo) : void {
	 	// create query template
	 	$query = "UPDATE currency SET currencyChange = :currencyChange, currencyCircSupply = :currencyCircSupply, currencyMarketCap = :currencyMarketCap, currencyPrice = :currencyPrice, currencyPricegraph = :currencyPricegraph, currencyVolume = :currencyVolume";
	 	$statement = $pdo->prepare($query);

		 $parameters = ["currencyId" => $this->currencyId->getBytes(),"currencyChange"=>$this->currencyChange, "currencyCircSupply"=>$this->currencyCircSupply, "currencyMarketCap"=>$this ->currencyMarketCap, "currencyPrice"=>$this->currencyPrice, "currencyPriceGraph"=>$this->currencyPricegraph, "currencyVolume"=>$this->currencyVolume];
		 $statement->execute($parameters);
 }



	 /**
	  * gets the Currency by currencyId
	  *
	  * @param \PDO $pdo PDO connection object
	  * @param Uuid|string $currencyId currency id to search for
	  * @return Currency|null Currency found or null if not found
	  * @throws \PDOException when mySQL related errors occur
	  * @throws \TypeError when a variable are not the correct data type
	  **/
 public static function getCurrencyByCurrencyId(\PDO $pdo, $currencyId) : ?Currency {
	 try {
		 $currencyId = self::validateUuid($currencyId);
	 } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		 throw(new \PDOException($exception->getMessage(), 0, $exception));
	 }

 		// create query template
	 $query = "SELECT currencyId, currencyChange, currencyCircSupply,currencyMarketCap,currencyPrice,currencyPricegraph,currencyVolume FROM currency WHERE currencyId = :currencyId";
	 $statement = $pdo->prepare($query);

	 //bind the currency id to the place holder in the template
	 $parameters = ["currencyId" => $currencyId ->getBytes()];
	 $statement->execute($parameters);

	 //grab the currency from MySQL
	 try{
	 	$currency = null;
	 	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	 	$row = $statement->fetch();
	 	if($row !== false) {
			$currency = new Currency($row["currencyId"], $row["currencyChange"], $row["currencyCircSupply"], $row["currencyMarketCap"], $row["currencyPrice"], $row["currencyPriceGraph"], $row["currencyVolume"]);
					}
		} catch(\Exception $exception) {
			 throw(new \PDOException($exception->getMessage(), 0, $exception));
		 }
		 return($currency);
	 }

/**
 * gets all Currencies
 *
 *
 *
 */

public static function getAllCurrencies(\PDO $pdo) : \SplFixedArray {
	//create query template
	$query = "SELECT currencyID, currencyChange, currencyCircSupply, currencyMarketCap, currencyPrice, currencyPriceGraph, currencyVolume from currency";
	$statement = $pdo->prepare($query);
	$statement->execute();

	//build an array of currencies
	$currencies = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement ->fetch()) !==false) {
		try {
			$currency = new Currency($row["currencyId"], $row["currencyChange"], $row["currencyCircSupply"], $row["currencyMarketCap"], $row["currencyPrice"], $row["currencyPriceGraph"],$row["currencyVolume"]);
			$currencies[$currencies->key()] = $currency;
			$currencies->next();
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(),0,$exception));
		}
	}
	return($currencies);

}

public function jsonSerialize() : array{
	
	$fields = get_object_vars($this);

	$fields["currencyId"] = $this->currencyId->toString();


}


	 //END OF CURRENCY CLASS
 }

?>