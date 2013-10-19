OperationsBundle
================

Gorkana Group Coding Exercise

Whole application can be launched by CalculatorController which is mapped to /operations/\<id\> (known ids are 1 - 3).

Model interface is represented by service Calculator. Its most important method is calculate which takes as an argument name of source. Source is read by IDataSourceHandler, parsed
by IParser and calculate by registered IOperationCalculators.

Final code might be considered as a little overhead but I wanted to do it as flexible as possible. You can add more operations, change data store (DB, file, web service whatever) or data format (XML, JSON etc.).