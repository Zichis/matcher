# Matcher

This is an api built with Laravel that helps real estate brokers get customer search profiles that fit a particular property.

## API

### Request

GET /api/match/{propertyId}

### Response

`"data" => [ ["searchProfileId" => {id}, "score" => {matchScore}, "strictMatchesCount" => {counter}, "loosesMatchesCount" => {counter}], ["searchProfileId" => {id}, "score" => {matchScore}, "strictMatchesCount" => {counter}, "loosesMatchesCount" => {counter}], [...] ]`
