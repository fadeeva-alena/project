using System;
using System.Collections.Generic;
using System.Web;
using System.Web.Services;
using System.Text;
using System.Xml;
using System.Data;

[WebService(Namespace = "http://tempuri.org/")]
[WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]

public class Service : System.Web.Services.WebService
{
    public Service()
    {

        //Uncomment the following line if using designed components 
        //InitializeComponent(); 
    }

    [WebMethod]
    public string HelloWorld()
    {
        return "Hello World";
    }

    [WebMethod]
    public XmlDocument Query(String Query)
    {
        XmlDocument document = new XmlDocument();
        try
        {
            try
            {
                DataSet ds = ClsDB.GetRecordSet(Query.Replace("delete", "").Replace("update", ""));
                if (ds.Tables.Count == 0)
                {
                    StringBuilder output = new StringBuilder();
                    XmlWriter writer = XmlWriter.Create(output);
                    writer.WriteStartDocument();
                    writer.WriteStartElement("detail");
                    writer.WriteValue("No table returned");
                    writer.WriteEndElement();
                    writer.Flush();
                    document.LoadXml(output.ToString());
                }
                else if (ds.Tables[0].Rows.Count == 0)
                {
                    StringBuilder output = new StringBuilder();
                    XmlWriter writer = XmlWriter.Create(output);
                    writer.WriteStartDocument();
                    writer.WriteStartElement("detail");
                    writer.WriteValue("No row returned");
                    writer.WriteEndElement();
                    writer.Flush();
                    document.LoadXml(output.ToString());
                }
                else
                {
                    StringBuilder output = new StringBuilder();
                    XmlWriter writer = XmlWriter.Create(output);
                    writer.WriteStartDocument();
                    writer.WriteStartElement("infoList");
                    foreach (DataRow row in ds.Tables[0].Rows)
                    {
                        writer.WriteStartElement("item");
                        foreach (DataColumn DtCol in ds.Tables[0].Columns)
                        {
                            writer.WriteStartElement(DtCol.ColumnName);
                            writer.WriteValue(row[DtCol.Ordinal].ToString());
                            writer.WriteEndElement();
                        }
                        writer.WriteEndElement();
                    }
                    writer.WriteEndElement();
                    writer.Flush();
                    document.LoadXml(output.ToString());
                    return document;
                }

            }
            catch (Exception)
            {
            }
        }
        finally
        {
        }
        return document;
    }
}