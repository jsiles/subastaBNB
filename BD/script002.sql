USE [subastaBNB]
GO
/****** Object:  Table [dbo].[mdl_subasta_aprobar]    Script Date: 09-May-17 12:38:06 AM ******/
DROP TABLE [dbo].[mdl_subasta_aprobar]
GO
/****** Object:  Table [dbo].[mdl_subasta_aprobar]    Script Date: 09-May-17 12:38:06 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[mdl_subasta_aprobar](
	[sup_uid] [int] IDENTITY(1,1) NOT NULL,
	[sup_sub_uid] [int] NOT NULL,
	[sup_user_uid] [int] NOT NULL,
	[sup_date] [datetime] NOT NULL,
	[sup_status] [varchar](8) NOT NULL,
 CONSTRAINT [PK_mdl_subasta_aprobar] PRIMARY KEY CLUSTERED 
(
	[sup_uid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO

ALTER TABLE mdl_subasta_informe ADD sua_usr_apr int null 
go