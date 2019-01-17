using System;
using System.Data;
using System.Configuration;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using System.Data.Odbc;

namespace SearchDB
{
    /// <summary>
    /// Summary description for Class1
    /// </summary>
    public class UtilData
    {
        // Fields
        private const string dsn = "DSN=MySQL;Uid=wssql;Pwd=schlaepferd_;";

        // Methods
        public static DataSet GetRecordSet(string sqlString)
        {
            OdbcConnection selectConnection = new OdbcConnection("DSN=MySQL;Uid=wssql;Pwd=schlaepferd_;");
            selectConnection.Open();
            OdbcDataAdapter adapter = new OdbcDataAdapter(sqlString, selectConnection);
            DataSet dataSet = new DataSet();
            adapter.Fill(dataSet);
            return dataSet;
        }
    }
}