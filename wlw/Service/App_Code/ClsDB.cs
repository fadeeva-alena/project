using System;
using System.Collections.Generic;
using System.Web;
using System.Data;
using System.Data.Odbc;

/// <summary>
/// Summary description for ClsDB
/// </summary>
public static class ClsDB
{
    // Methods
    public static DataSet GetRecordSet(string sqlString)
    {
        //OdbcConnection selectConnection = new OdbcConnection("Data Source=www.manimano.ch;Database=wu_db;User ID=wssql2;Password=dkie93?)k30%");
        OdbcConnection selectConnection = new OdbcConnection("DRIVER={MySQL ODBC 3.51 Driver};SERVER=www.manimano.ch;DATABASE=wu_db;UID=wssql2;PASSWORD=dkie93?)k30%;OPTION=3");
        selectConnection.Open();
        OdbcDataAdapter adapter = new OdbcDataAdapter(sqlString, selectConnection);
        DataSet dataSet = new DataSet();
        adapter.Fill(dataSet);
        return dataSet;
    }
}